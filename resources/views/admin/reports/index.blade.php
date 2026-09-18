<x-admin.layout title="Reports">
    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-accent">Reports</p>
                <h1 class="mt-1 text-2xl font-bold text-navy">Operational Reports</h1>
                <p class="mt-1 text-sm text-muted">Live summaries from your projects, clients, content, and consultation activity.</p>
            </div>
            <a href="{{ route('admin.reports.export') }}" class="admin-btn-primary"><x-admin.icon name="external" class="h-4 w-4" /> Export Projects CSV</a>
        </div>

        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-7">
            @foreach ($summary as $item)
                <a href="{{ $item['href'] }}" class="admin-stat-card hover:border-accent">
                    <p class="text-xs font-medium uppercase tracking-wide text-muted">{{ $item['label'] }}</p>
                    <p class="text-2xl font-bold text-navy">{{ $item['value'] }}</p>
                    <span class="text-xs font-semibold text-accent">Open module &rarr;</span>
                </a>
            @endforeach
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <section class="admin-card p-5">
                <h2 class="text-base font-semibold text-navy">Project Status</h2>
                <p class="mt-1 text-sm text-muted">Current distribution of all projects.</p>
                @if ($projectStatuses)
                    <div class="mt-5 space-y-4">
                        @foreach ($projectStatuses as $status)
                            <div>
                                <div class="mb-1 flex items-center justify-between text-sm"><span class="font-medium text-navy">{{ $status['label'] }}</span><span class="text-muted">{{ $status['total'] }}</span></div>
                                <div class="h-2 overflow-hidden rounded-full bg-surface"><div class="h-full rounded-full bg-accent" style="width: {{ max(8, ($status['total'] / max(1, array_sum(array_column($projectStatuses, 'total')))) * 100) }}%"></div></div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mt-5 text-sm text-muted">No project data yet.</p>
                @endif
            </section>

            <section class="admin-card p-5">
                <h2 class="text-base font-semibold text-navy">Consultation Request Status</h2>
                <p class="mt-1 text-sm text-muted">Current distribution of requests from Contact Us and live chat.</p>
                @if ($requestStatuses)
                    <div class="mt-5 grid gap-3 sm:grid-cols-2">
                        @foreach ($requestStatuses as $status)
                            <a href="{{ route('admin.consultation-requests.index', ['status' => strtolower(str_replace(' ', '_', $status['label']))]) }}" class="rounded-lg border border-navy/10 p-4 hover:border-accent"><p class="text-xs uppercase tracking-wide text-muted">{{ $status['label'] }}</p><p class="mt-1 text-2xl font-bold text-navy">{{ $status['total'] }}</p></a>
                        @endforeach
                    </div>
                @else
                    <p class="mt-5 text-sm text-muted">No consultation requests yet.</p>
                @endif
            </section>
        </div>

        <section class="admin-card overflow-hidden">
            <div class="flex items-center justify-between border-b border-navy/10 p-5"><div><h2 class="text-base font-semibold text-navy">Upcoming Project Deadlines</h2><p class="mt-1 text-sm text-muted">Next scheduled delivery dates from live project data.</p></div><a href="{{ route('admin.projects.index') }}" class="text-sm font-semibold text-accent hover:text-amber-600">View Projects &rarr;</a></div>
            @if ($deadlines->isEmpty())
                <p class="p-5 text-sm text-muted">No upcoming deadlines.</p>
            @else
                <div class="overflow-x-auto"><table class="w-full text-left text-sm"><thead class="border-b border-navy/10 text-xs uppercase tracking-wide text-muted"><tr><th class="px-5 py-3 font-medium">Project</th><th class="px-5 py-3 font-medium">Client</th><th class="px-5 py-3 font-medium">Deadline</th><th class="px-5 py-3 font-medium">Progress</th><th class="px-5 py-3 text-right font-medium">Action</th></tr></thead><tbody class="divide-y divide-navy/5">@foreach ($deadlines as $project)<tr><td class="px-5 py-4 font-semibold text-navy">{{ $project->name }}</td><td class="px-5 py-4 text-muted">{{ $project->client->company ?: $project->client->name }}</td><td class="px-5 py-4 whitespace-nowrap text-muted">{{ $project->deadline->format('d M Y') }}</td><td class="px-5 py-4 text-muted">{{ $project->progress }}%</td><td class="px-5 py-4 text-right"><a href="{{ route('admin.projects.show', $project) }}" class="text-sm font-semibold text-accent hover:text-amber-600">View</a></td></tr>@endforeach</tbody></table></div>
            @endif
        </section>

    </div>
</x-admin.layout>
