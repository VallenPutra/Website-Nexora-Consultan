<x-admin.layout title="Projects">
    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-accent">Business Management</p>
                <h1 class="mt-1 text-2xl font-bold text-navy">Projects</h1>
                <p class="mt-1 text-sm text-muted">Track delivery progress, deadlines, and client work.</p>
            </div>
            <a href="{{ route('admin.projects.create') }}" class="admin-btn-primary"><x-admin.icon name="plus" class="h-4 w-4" /> Add Project</a>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
        @endif

        <div class="admin-card overflow-hidden">
            <div class="border-b border-navy/10 p-4">
                <form method="GET" action="{{ route('admin.projects.index') }}" class="flex max-w-md items-center gap-2">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Search projects..." class="min-w-0 flex-1 rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    <button type="submit" class="admin-btn-secondary">Search</button>
                </form>
            </div>

            @if ($projects->isEmpty())
                <div class="p-5"><x-admin.empty-state title="No projects yet" description="Add a project to start tracking client work." icon="projects"><a href="{{ route('admin.projects.create') }}" class="admin-btn-primary mt-6">Add First Project</a></x-admin.empty-state></div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-navy/10 text-xs uppercase tracking-wide text-muted">
                            <tr><th class="px-5 py-3 font-medium">Project</th><th class="px-5 py-3 font-medium">Client</th><th class="px-5 py-3 font-medium">Progress</th><th class="px-5 py-3 font-medium">Status</th><th class="px-5 py-3 font-medium">Deadline</th><th class="px-5 py-3 text-right font-medium">Action</th></tr>
                        </thead>
                        <tbody class="divide-y divide-navy/5">
                            @foreach ($projects as $project)
                                <tr class="hover:bg-surface/70">
                                    <td class="px-5 py-4"><a href="{{ route('admin.projects.show', $project) }}" class="font-semibold text-navy hover:text-accent">{{ $project->name }}</a><p class="mt-0.5 text-xs text-muted">{{ $project->service ?: 'No service assigned' }}</p></td>
                                    <td class="px-5 py-4 text-muted">{{ $project->client->company ?: $project->client->name }}</td>
                                    <td class="px-5 py-4"><div class="flex min-w-32 items-center gap-2"><x-admin.progress-bar :value="$project->progress" /><span class="text-xs text-muted">{{ $project->progress }}%</span></div></td>
                                    <td class="px-5 py-4"><span class="admin-badge {{ $project->status === 'completed' ? 'admin-badge-success' : ($project->status === 'on_review' ? 'admin-badge-warning' : 'admin-badge-info') }}">{{ ucwords(str_replace('_', ' ', $project->status)) }}</span></td>
                                    <td class="px-5 py-4 whitespace-nowrap text-muted">{{ $project->deadline?->format('d M Y') ?: '—' }}</td>
                                    <td class="px-5 py-4 text-right"><a href="{{ route('admin.projects.edit', $project) }}" class="text-sm font-semibold text-accent hover:text-amber-600">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="border-t border-navy/10 px-5 py-4">{{ $projects->links() }}</div>
            @endif
        </div>
    </div>
</x-admin.layout>
