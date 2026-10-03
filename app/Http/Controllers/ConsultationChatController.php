<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationChatRequest;
use App\Models\ConsultationMessage;
use App\Models\ConsultationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConsultationChatController extends Controller
{
    public function start(ConsultationChatRequest $request): JsonResponse
    {
        $user = $request->user();
        $existingConsultation = ConsultationRequest::where('user_id', $user->id)
            ->where('status', '<>', 'closed')
            ->latest()
            ->first();

        if ($existingConsultation) {
            return response()->json(['token' => $existingConsultation->chat_token, ...$this->chatState($existingConsultation)]);
        }

        $consultation = ConsultationRequest::create([
            'user_id' => $user->id,
            'chat_token' => (string) Str::uuid(),
            'name' => $user->name,
            'email' => $user->email,
            'service' => 'Live Consultation',
            'budget' => 'Not specified',
            'message' => $request->validated('message'),
            'status' => 'new',
        ]);
        $consultation->chatMessages()->create(['sender_type' => 'visitor', 'body' => $request->validated('message')]);

        return response()->json(['token' => $consultation->chat_token, ...$this->chatState($consultation)]);
    }

    public function current(Request $request): JsonResponse
    {
        $consultation = ConsultationRequest::where('user_id', $request->user()->id)
            ->where('status', '<>', 'closed')
            ->latest()
            ->first();

        if (! $consultation) {
            return response()->json([
                'token' => null,
                'messages' => [],
                'handler_name' => null,
                'is_typing' => false,
                'notice' => $this->chatNotice(),
            ]);
        }

        return response()->json(['token' => $consultation->chat_token, ...$this->chatState($consultation)]);
    }

    public function messages(Request $request, string $token): JsonResponse
    {
        $consultation = ConsultationRequest::where('chat_token', $token)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return response()->json($this->chatState($consultation));
    }

    public function send(Request $request, string $token): JsonResponse
    {
        $validated = $request->validate(['body' => ['required', 'string', 'max:3000']]);
        $consultation = ConsultationRequest::where('chat_token', $token)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $message = DB::transaction(function () use ($consultation, $validated): ?ConsultationMessage {
            $lockedConsultation = ConsultationRequest::whereKey($consultation->id)
                ->lockForUpdate()
                ->firstOrFail();
            $latestMessage = $lockedConsultation->chatMessages()->latest('id')->first();

            if ($latestMessage && $latestMessage->sender_type !== 'admin') {
                return null;
            }

            if ($lockedConsultation->status === 'closed') {
                $lockedConsultation->update(['status' => 'new']);
            }

            return $lockedConsultation->chatMessages()->create([
                'sender_type' => 'visitor',
                'body' => $validated['body'],
            ]);
        });

        if (! $message) {
            return response()->json(['message' => __('site.chat.waiting_reply')], 422);
        }

        return response()->json(['message' => $this->formatMessage($message)]);
    }

    private function formatMessage(ConsultationMessage $message): array
    {
        return ['id' => $message->id, 'sender' => $message->sender_type, 'body' => $message->body, 'time' => $message->created_at->format('H:i')];
    }

    /**
     * @return array{messages: Collection<int, array{id: int, sender: string, body: string, time: string}>, handler_name: ?string, is_typing: bool, notice: string, can_reply: bool}
     */
    private function chatState(ConsultationRequest $consultation): array
    {
        $chatMessages = $consultation->chatMessages()->oldest('id')->get();
        $latestMessage = $chatMessages->last();

        return [
            'messages' => $chatMessages->map(fn (ConsultationMessage $message): array => $this->formatMessage($message)),
            'handler_name' => $consultation->handled_by,
            'is_typing' => Cache::has($this->typingCacheKey($consultation->chat_token)),
            'notice' => $this->chatNotice(),
            'can_reply' => ! $latestMessage || $latestMessage->sender_type === 'admin',
        ];
    }

    private function chatNotice(): string
    {
        return __('site.chat.notice');
    }

    private function typingCacheKey(string $token): string
    {
        return 'consultation-chat-typing:'.$token;
    }
}
