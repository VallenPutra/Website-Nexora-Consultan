<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConsultationMessageRequest;
use App\Models\ConsultationRequest;
use Illuminate\Http\RedirectResponse;

class ConsultationMessageController extends Controller
{
    public function store(ConsultationMessageRequest $request, ConsultationRequest $consultationRequest): RedirectResponse
    {
        $consultationRequest->chatMessages()->create(['sender_type' => 'admin', 'body' => $request->validated('body')]);
        $consultationRequest->update(['status' => 'contacted']);

        return redirect()->route('admin.consultation-requests.show', $consultationRequest)->with('status', 'Reply sent.');
    }
}
