<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ConsultationRequest;
use App\Models\Insight;
use App\Models\Project;
use App\Models\Revenue;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(): View
    {
        $projectStatuses = Project::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->orderByDesc('total')
            ->get()
            ->map(fn (Project $project): array => [
                'label' => ucwords(str_replace('_', ' ', $project->status)),
                'total' => $project->total,
            ])
            ->all();

        $requestStatuses = ConsultationRequest::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->orderByDesc('total')
            ->get()
            ->map(fn (ConsultationRequest $request): array => [
                'label' => ucwords(str_replace('_', ' ', $request->status)),
                'total' => $request->total,
            ])
            ->all();

        $deadlines = Project::query()
            ->with('client')
            ->whereNotNull('deadline')
            ->whereDate('deadline', '>=', today())
            ->orderBy('deadline')
            ->limit(8)
            ->get();

        return view('admin.reports.index', [
            'summary' => [
                ['label' => 'Projects', 'value' => Project::count(), 'href' => route('admin.projects.index')],
                ['label' => 'Clients', 'value' => Client::count(), 'href' => route('admin.clients.index')],
                ['label' => 'Active Services', 'value' => Service::active()->count(), 'href' => route('admin.services.index')],
                ['label' => 'Active Team', 'value' => TeamMember::active()->count(), 'href' => route('admin.team.index')],
                ['label' => 'Published Insights', 'value' => Insight::published()->count(), 'href' => route('admin.insights.index')],
                ['label' => 'Consultation Requests', 'value' => ConsultationRequest::count(), 'href' => route('admin.consultation-requests.index')],
                ['label' => 'Revenue Collected', 'value' => 'Rp'.number_format(Revenue::paid()->sum('amount'), 0, ',', '.'), 'href' => route('admin.revenue.index')],
            ],
            'projectStatuses' => $projectStatuses,
            'requestStatuses' => $requestStatuses,
            'deadlines' => $deadlines,
        ]);
    }

    public function export(): StreamedResponse
    {
        $projects = Project::query()->with('client')->orderBy('status')->orderBy('name')->get();

        return response()->streamDownload(function () use ($projects): void {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Project', 'Client', 'Service', 'Progress', 'Status', 'Deadline']);

            foreach ($projects as $project) {
                fputcsv($handle, [
                    $project->name,
                    $project->client->company ?: $project->client->name,
                    $project->service,
                    $project->progress.'%',
                    ucwords(str_replace('_', ' ', $project->status)),
                    $project->deadline?->format('Y-m-d'),
                ]);
            }

            fclose($handle);
        }, 'nexora-project-report-'.now()->format('Y-m-d').'.csv', ['Content-Type' => 'text/csv']);
    }
}
