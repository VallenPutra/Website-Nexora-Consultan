<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        return view('admin.dashboard', [
            'adminName' => $adminName,
            'today' => now(),
            'isLive' => AdminDemoData::isLive(),
            'stats' => AdminDemoData::stats(),
            'projects' => AdminDemoData::projects(),
            'revenue' => AdminDemoData::revenueByMonth(),
            'requests' => AdminDemoData::consultationRequests(),
            'activity' => AdminDemoData::recentActivity(),
            'deadlines' => AdminDemoData::upcomingDeadlines(),
        ]);
    }
}
