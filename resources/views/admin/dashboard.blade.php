@php
    $formatRupiah = fn (int $n) => 'Rp'.number_format($n, 0, ',', '.');
    $priorityTone = fn (string $p) => match ($p) {
        'High' => 'admin-badge-danger',
        'Medium' => 'admin-badge-warning',
        default => 'admin-badge-neutral',
    };
@endphp

<x-admin.layout title="Dashboard" :admin-name="$adminName">

    <div class="mx-auto max-w-7xl space-y-6">

        @unless ($isLive)
            <x-admin.demo-notice />
        @endunless

        {{-- Greeting --}}
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-navy">Good morning, {{ $adminName }}.</h2>
                <p class="mt-1 text-sm text-muted">Here's what's happening in your consulting business today.</p>
            </div>
            <p class="text-sm font-medium text-muted">{{ $today->format('l, j F Y') }}</p>
        </div>

        {{-- Statistic cards --}}
        <div class="grid grid-cols-2 gap-4 lg:grid-cols-5">
            @foreach ($stats as $stat)
                <x-admin.stat-card
                    :label="$stat['label']"
                    :value="$stat['value']"
                    :trend="$stat['trend']"
                    :trend-direction="$stat['trend_direction']"
                    :icon="$stat['icon']"
                />
            @endforeach
        </div>

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Project Overview --}}
            <div class="admin-card p-5 lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-navy">Project Overview</h3>
                    <a href="{{ route('admin.placeholder', 'projects') }}" class="text-sm font-semibold text-accent hover:text-amber-600">View All Projects →</a>
                </div>

                {{-- Table on larger screens --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-xs uppercase tracking-wide text-muted border-b border-navy/10">
                                <th class="pb-2.5 font-medium">Project</th>
                                <th class="pb-2.5 font-medium">Client</th>
                                <th class="pb-2.5 font-medium">Service</th>
                                <th class="pb-2.5 font-medium w-32">Progress</th>
                                <th class="pb-2.5 font-medium">Status</th>
                                <th class="pb-2.5 font-medium">Deadline</th>
                                <th class="pb-2.5 font-medium sr-only">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-navy/5">
                            @foreach ($projects as $project)
                                <tr>
                                    <td class="py-3 pr-3 font-medium text-navy">{{ $project['name'] }}</td>
                                    <td class="py-3 pr-3 text-charcoal">{{ $project['client'] }}</td>
                                    <td class="py-3 pr-3 text-muted">{{ $project['service'] }}</td>
                                    <td class="py-3 pr-3"><x-admin.progress-bar :value="$project['progress']" /></td>
                                    <td class="py-3 pr-3"><x-admin.status-badge :status="$project['status']" /></td>
                                    <td class="py-3 pr-3 text-muted whitespace-nowrap">{{ \Illuminate\Support\Carbon::parse($project['deadline'])->format('d M Y') }}</td>
                                    <td class="py-3 text-right">
                                        <a href="{{ route('admin.placeholder', 'projects') }}" class="text-xs font-semibold text-accent hover:text-amber-600 whitespace-nowrap">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Card list on mobile --}}
                <div class="md:hidden space-y-3">
                    @foreach ($projects as $project)
                        <div class="rounded-lg border border-navy/10 p-3.5">
                            <div class="flex items-start justify-between gap-2">
                                <p class="font-medium text-navy text-sm">{{ $project['name'] }}</p>
                                <x-admin.status-badge :status="$project['status']" />
                            </div>
                            <p class="text-xs text-muted mt-1">{{ $project['client'] }} &middot; {{ $project['service'] }}</p>
                            <div class="mt-3"><x-admin.progress-bar :value="$project['progress']" /></div>
                            <p class="text-xs text-muted mt-2">Deadline: {{ \Illuminate\Support\Carbon::parse($project['deadline'])->format('d M Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="admin-card p-5">
                <h3 class="text-base font-semibold text-navy mb-4">Quick Actions</h3>
                <div class="space-y-2.5">
                    <a href="{{ route('admin.placeholder', 'projects') }}" class="admin-btn-secondary w-full justify-start">
                        <x-admin.icon name="plus" class="w-4 h-4" /> Add New Project
                    </a>
                    <a href="{{ route('admin.placeholder', 'clients') }}" class="admin-btn-secondary w-full justify-start">
                        <x-admin.icon name="plus" class="w-4 h-4" /> Add New Client
                    </a>
                    <a href="{{ route('admin.placeholder', 'insights') }}" class="admin-btn-secondary w-full justify-start">
                        <x-admin.icon name="plus" class="w-4 h-4" /> Create Insight
                    </a>
                    <a href="{{ route('admin.placeholder', 'consultation-requests') }}" class="admin-btn-secondary w-full justify-start">
                        <x-admin.icon name="requests" class="w-4 h-4" /> View Consultation Requests
                    </a>
                    <a href="{{ route('home') }}" target="_blank" rel="noopener" class="admin-btn-primary w-full justify-start">
                        <x-admin.icon name="external" class="w-4 h-4" /> View Public Website
                    </a>
                </div>
                <p class="mt-4 text-xs text-muted leading-relaxed">
                    Actions above open their module page. Create/save actions aren't wired to a database yet, so nothing is actually stored until those modules are built.
                </p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Revenue Overview --}}
            <div class="admin-card p-5 lg:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <h3 class="text-base font-semibold text-navy">Revenue Overview</h3>
                    <span class="admin-badge admin-badge-warning">Demo Data</span>
                </div>
                <p class="text-xs text-muted mb-4">Last 6 months &middot; not connected to real financial data yet</p>
                <x-admin.revenue-chart :data="$revenue" />
            </div>

            {{-- Upcoming Deadlines --}}
            <div class="admin-card p-5">
                <h3 class="text-base font-semibold text-navy mb-4">Upcoming Deadlines</h3>
                <ul class="space-y-4">
                    @foreach ($deadlines as $item)
                        @php
                            $daysLeft = now()->diffInDays(\Illuminate\Support\Carbon::parse($item['deadline']), false);
                        @endphp
                        <li class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-navy truncate">{{ $item['project'] }}</p>
                                <p class="text-xs text-muted mt-0.5">
                                    {{ \Illuminate\Support\Carbon::parse($item['deadline'])->format('d M Y') }}
                                    &middot; {{ $daysLeft >= 0 ? $daysLeft.' days left' : 'Overdue' }}
                                </p>
                            </div>
                            <span class="admin-badge {{ $priorityTone($item['priority']) }} shrink-0">{{ $item['priority'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Consultation Requests --}}
            <div class="admin-card p-5 lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-navy">Recent Consultation Requests</h3>
                    <a href="{{ route('admin.placeholder', 'consultation-requests') }}" class="text-sm font-semibold text-accent hover:text-amber-600">View All Requests →</a>
                </div>
                <ul class="divide-y divide-navy/5">
                    @foreach ($requests as $req)
                        <li class="flex items-center justify-between gap-3 py-3">
                            <div class="min-w-0 flex items-center gap-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-surface text-navy text-sm font-semibold">
                                    {{ strtoupper(substr($req['name'], 0, 1)) }}
                                </span>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-navy truncate">{{ $req['name'] }}</p>
                                    <p class="text-xs text-muted truncate">{{ $req['company'] }} &middot; {{ $req['service'] }}</p>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <x-admin.status-badge :status="$req['status']" />
                                <p class="text-xs text-muted mt-1">{{ $req['date'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Recent Activity --}}
            <div class="admin-card p-5">
                <h3 class="text-base font-semibold text-navy mb-4">Recent Activity</h3>
                <ul class="space-y-4">
                    @foreach ($activity as $item)
                        <x-admin.activity-item
                            :description="$item['description']"
                            :time="$item['time']"
                            :icon="$item['icon']"
                            :tone="$item['tone']"
                        />
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</x-admin.layout>
