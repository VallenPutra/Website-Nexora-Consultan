<x-admin.layout title="Project Details">
    <div class="mx-auto max-w-4xl space-y-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div><a href="{{ route('admin.projects.index') }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Projects</a><h1 class="mt-3 text-2xl font-bold text-navy">{{ $project->name }}</h1><p class="mt-1 text-sm text-muted">{{ $project->client->company ?: $project->client->name }}</p></div>
            <div class="flex gap-3"><a href="{{ route('admin.projects.edit', $project) }}" class="admin-btn-primary">Edit Project</a><form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project?')">@csrf @method('DELETE')<button type="submit" class="admin-btn-secondary text-red-600 hover:border-red-300 hover:text-red-700">Delete</button></form></div>
        </div>
        @if (session('status'))<div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>@endif
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="admin-card p-5 lg:col-span-2"><h2 class="text-base font-semibold text-navy">Project Details</h2><dl class="mt-5 grid gap-5 sm:grid-cols-2"><div><dt class="text-xs uppercase tracking-wide text-muted">Client</dt><dd class="mt-1 text-sm text-charcoal">{{ $project->client->name }}{{ $project->client->company ? ' — '.$project->client->company : '' }}</dd></div><div><dt class="text-xs uppercase tracking-wide text-muted">Service</dt><dd class="mt-1 text-sm text-charcoal">{{ $project->service ?: '—' }}</dd></div><div><dt class="text-xs uppercase tracking-wide text-muted">Deadline</dt><dd class="mt-1 text-sm text-charcoal">{{ $project->deadline?->format('d M Y') ?: '—' }}</dd></div><div><dt class="text-xs uppercase tracking-wide text-muted">Created</dt><dd class="mt-1 text-sm text-charcoal">{{ $project->created_at->format('d M Y') }}</dd></div></dl></div>
            <div class="admin-card p-5"><h2 class="text-base font-semibold text-navy">Progress</h2><p class="mt-4 text-3xl font-bold text-navy">{{ $project->progress }}%</p><div class="mt-3"><x-admin.progress-bar :value="$project->progress" /></div><span class="admin-badge {{ $project->status === 'completed' ? 'admin-badge-success' : ($project->status === 'on_review' ? 'admin-badge-warning' : 'admin-badge-info') }} mt-5">{{ ucwords(str_replace('_', ' ', $project->status)) }}</span></div>
        </div>
        <div class="admin-card p-5"><h2 class="text-base font-semibold text-navy">Description</h2><p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-muted">{{ $project->description ?: 'No description has been added.' }}</p></div>
    </div>
</x-admin.layout>
