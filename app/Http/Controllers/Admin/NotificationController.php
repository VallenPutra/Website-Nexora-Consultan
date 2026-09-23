<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultationMessage;
use App\Models\ConsultationRequest;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function index(): JsonResponse
    {
        $newRequests = ConsultationRequest::query()
            ->where('status', 'new')
            ->whereDoesntHave('chatMessages')
            ->latest()
            ->limit(10)
            ->get(['id', 'name', 'company', 'created_at'])
            ->map(fn (ConsultationRequest $consultationRequest): array => [
                'id' => 'request-'.$consultationRequest->id,
                'type' => 'request',
                'name' => $consultationRequest->name,
                'company' => $consultationRequest->company ?: 'Individual client',
                'time' => $consultationRequest->created_at->diffForHumans(),
                'url' => route('admin.consultation-requests.show', $consultationRequest),
            ]);

        $chatMessages = ConsultationMessage::query()
            ->select([
                'consultation_messages.id',
                'consultation_messages.created_at',
                'consultation_requests.id as request_id',
                'consultation_requests.name',
                'consultation_requests.company',
            ])
            ->join('consultation_requests', 'consultation_requests.id', '=', 'consultation_messages.consultation_request_id')
            ->where('consultation_messages.sender_type', 'visitor')
            ->whereNotExists(function (Builder $query): void {
                $query->selectRaw('1')
                    ->from('consultation_messages as admin_messages')
                    ->whereColumn('admin_messages.consultation_request_id', 'consultation_messages.consultation_request_id')
                    ->where('admin_messages.sender_type', 'admin')
                    ->whereColumn('admin_messages.created_at', '>', 'consultation_messages.created_at');
            })
            ->latest('consultation_messages.created_at')
            ->limit(10)
            ->get()
            ->map(fn (ConsultationMessage $message): array => [
                'id' => 'message-'.$message->id,
                'type' => 'message',
                'name' => $message->name,
                'company' => $message->company ?: 'Individual client',
                'time' => Carbon::parse($message->created_at)->diffForHumans(),
                'url' => route('admin.consultation-requests.show', $message->request_id),
            ]);

        $notifications = $newRequests->concat($chatMessages)->values();

        return response()->json([
            'count' => $notifications->count(),
            'notifications' => $notifications,
        ]);
    }
}
