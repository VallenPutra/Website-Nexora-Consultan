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
use App\Support\AdminDemoData;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Auth is now wired up (see routes/web.php + Auth\* controllers), so
        // $request->user() is always populated here — the '?? Vallen' fallback
        // only matters if this action is ever reached without the 'auth'
        // middleware (it shouldn't be, since the /admin group requires it).
        $adminName = $request->user()?->name ?? 'Vallen';
        $stats = [
            ['label' => 'Total Projects', 'value' => (string) Project::count(), 'trend' => 'From database', 'trend_direction' => 'neutral', 'icon' => 'projects'],
            ['label' => 'Active Projects', 'value' => (string) Project::whereIn('status', ['planning', 'in_progress', 'on_review'])->count(), 'trend' => 'Currently in progress', 'trend_direction' => 'neutral', 'icon' => 'active'],
            ['label' => 'Total Clients', 'value' => (string) Client::count(), 'trend' => 'From database', 'trend_direction' => 'neutral', 'icon' => 'clients'],
            ['label' => 'Active Services', 'value' => (string) Service::active()->count(), 'trend' => 'Public catalog', 'trend_direction' => 'neutral', 'icon' => 'services'],
            ['label' => 'Published Insights', 'value' => (string) Insight::published()->count(), 'trend' => 'Public content', 'trend_direction' => 'neutral', 'icon' => 'insights'],
        ];

        $projects = Project::query()
            ->with('client')
            ->latest()
            ->limit(5)
            ->get()
            ->map(fn (Project $project): array => [
                'id' => $project->id,
                'name' => $project->name,
                'client' => $project->client->company ?: $project->client->name,
                'service' => $project->service ?: '—',
                'progress' => $project->progress,
                'status' => ucwords(str_replace('_', ' ', $project->status)),
                'deadline' => $project->deadline?->format('Y-m-d'),
            ])
            ->all();

        $deadlines = Project::query()
            ->whereNotNull('deadline')
            ->orderBy('deadline')
            ->limit(4)
            ->get()
            ->map(function (Project $project): array {
                $daysLeft = (int) now()->startOfDay()->diffInDays($project->deadline->startOfDay(), false);

                return [
                    'project' => $project->name,
                    'deadline' => $project->deadline->format('Y-m-d'),
                    'days_left' => $daysLeft,
                    'priority' => $daysLeft < 0 ? 'High' : ($daysLeft <= 7 ? 'Medium' : 'Low'),
                ];
            })
            ->all();

        $revenueByMonth = Revenue::query()
            ->paid()
            ->where('paid_at', '>=', now()->subMonths(5)->startOfMonth())
            ->get()
            ->groupBy(fn (Revenue $revenue): string => $revenue->paid_at->format('Y-m'))
            ->map(fn ($group, $key): array => [
                'month' => Carbon::createFromFormat('Y-m', $key)->format('M'),
                'amount' => $group->sum('amount'),
            ]);

        $revenue = collect(range(5, 0))
            ->map(fn (int $monthsAgo) => now()->subMonths($monthsAgo)->format('Y-m'))
            ->map(fn (string $key) => $revenueByMonth->get($key) ?? [
                'month' => Carbon::createFromFormat('Y-m', $key)->format('M'),
                'amount' => 0,
            ])
            ->values()
            ->all();

        $monthlyRevenue = Revenue::query()
            ->paid()
            ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('amount');

        $contentStats = [
            'team' => TeamMember::active()->count(),
            'media' => count(Storage::disk('public')->files('media')),
        ];

        $latestInsights = Insight::published()
            ->latest('published_at')
            ->latest('id')
            ->limit(4)
            ->get();

        $requests = ConsultationRequest::query()
            ->latest()
            ->limit(4)
            ->get()
            ->map(fn (ConsultationRequest $consultationRequest): array => [
                'id' => $consultationRequest->id,
                'name' => $consultationRequest->name,
                'company' => $consultationRequest->company ?: 'Individual client',
                'service' => $consultationRequest->service,
                'date' => $consultationRequest->created_at->diffForHumans(),
                'status' => ucwords(str_replace('_', ' ', $consultationRequest->status)),
            ])
            ->all();

        return view('admin.dashboard', [
            'adminName' => $adminName,
            'today' => now(),
            'stats' => $stats,
            'projects' => $projects,
            'revenue' => $revenue,
            'monthlyRevenue' => $monthlyRevenue,
            'requests' => $requests,
            'activity' => AdminDemoData::recentActivity(),
            'deadlines' => $deadlines,
            'contentStats' => $contentStats,
            'latestInsights' => $latestInsights,
        ]);
    }
}
