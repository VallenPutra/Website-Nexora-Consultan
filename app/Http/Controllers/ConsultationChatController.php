<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationChatRequest;
use App\Models\ConsultationMessage;
use App\Models\ConsultationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConsultationChatController extends Controller
{
    public function start(ConsultationChatRequest $request): JsonResponse
    {
        $consultation = ConsultationRequest::create([
            'chat_token' => (string) Str::uuid(),
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'service' => 'Live Consultation',
            'budget' => 'Not specified',
            'message' => $request->validated('message'),
            'status' => 'new',
        ]);
        $message = $consultation->chatMessages()->create(['sender_type' => 'visitor', 'body' => $request->validated('message')]);

        return response()->json(['token' => $consultation->chat_token, 'messages' => [$this->formatMessage($message)]]);
    }

    public function messages(string $token): JsonResponse
    {
        $consultation = ConsultationRequest::where('chat_token', $token)->firstOrFail();

        return response()->json(['messages' => $consultation->chatMessages()->oldest()->get()->map(fn (ConsultationMessage $message): array => $this->formatMessage($message))]);
    }

    public function send(Request $request, string $token): JsonResponse
    {
        $validated = $request->validate(['body' => ['required', 'string', 'max:3000']]);
        $consultation = ConsultationRequest::where('chat_token', $token)->firstOrFail();
        $message = $consultation->chatMessages()->create(['sender_type' => 'visitor', 'body' => $validated['body']]);

        if ($consultation->status === 'closed') {
            $consultation->update(['status' => 'new']);
        }

        return response()->json(['message' => $this->formatMessage($message)]);
    }

    private function formatMessage(ConsultationMessage $message): array
    {
        return ['id' => $message->id, 'sender' => $message->sender_type, 'body' => $message->body, 'time' => $message->created_at->format('H:i')];
    }
}
