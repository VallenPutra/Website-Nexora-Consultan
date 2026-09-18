<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Support\AdminDemoData;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Auth is now wired up (see routes/web.php + Auth\* controllers), so
        // $request->user() is always populated here — the '?? Vallen' fallback
        // only matters if this action is ever reached without the 'auth'
        // middleware (it shouldn't be, since the /admin group requires it).
        $adminName = $request->user()?->name ?? 'Vallen';
        $stats = AdminDemoData::stats();
        $stats[0]['value'] = (string) Project::count();
        $stats[1]['value'] = (string) Project::whereIn('status', ['planning', 'in_progress', 'on_review'])->count();
        $stats[2]['value'] = (string) Client::count();

        $projects = Project::query()
            ->with('client')
            ->latest()
            ->limit(5)
            ->get()
            ->map(fn (Project $project): array => [
                'name' => $project->name,
                'client' => $project->client->company ?: $project->client->name,
                'service' => $project->service ?: '—',
                'progress' => $project->progress,
                'status' => ucwords(str_replace('_', ' ', $project->status)),
                'deadline' => $project->deadline?->format('Y-m-d'),
            ])
            ->all();

        return view('admin.dashboard', [
            'adminName' => $adminName,
            'today' => now(),
            'isLive' => AdminDemoData::isLive(),
            'stats' => $stats,
            'projects' => $projects,
            'revenue' => AdminDemoData::revenueByMonth(),
            'requests' => AdminDemoData::consultationRequests(),
            'activity' => AdminDemoData::recentActivity(),
            'deadlines' => AdminDemoData::upcomingDeadlines(),
        ]);
    }
}
