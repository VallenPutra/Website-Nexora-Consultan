<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConsultationMessageRequest;
use App\Models\ConsultationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class ConsultationMessageController extends Controller
{
    public function store(ConsultationMessageRequest $request, ConsultationRequest $consultationRequest): RedirectResponse
    {
        $consultationRequest->chatMessages()->create(['sender_type' => 'admin', 'body' => $request->validated('body')]);
        $consultationRequest->update(['status' => 'contacted', 'handled_by' => $request->user()->name]);
        Cache::forget($this->typingCacheKey($consultationRequest->chat_token));

        return redirect()->route('admin.consultation-requests.show', $consultationRequest)->with('status', 'Reply sent.');
    }

    public function typing(Request $request, ConsultationRequest $consultationRequest): Response
    {
        $cacheKey = $this->typingCacheKey($consultationRequest->chat_token);

        if ($request->boolean('is_typing')) {
            Cache::put($cacheKey, $request->user()->name, now()->addSeconds(8));
        } else {
            Cache::forget($cacheKey);
        }

        return response()->noContent();
    }

    private function typingCacheKey(string $token): string
    {
        return 'consultation-chat-typing:'.$token;
    }
}
