<x-admin.layout title="Edit Project">
    <div class="mx-auto max-w-3xl space-y-6">
        <div><a href="{{ route('admin.projects.show', $project) }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Project</a><h1 class="mt-3 text-2xl font-bold text-navy">Edit Project</h1><p class="mt-1 text-sm text-muted">Update {{ $project->name }}.</p></div>
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="admin-card p-5 sm:p-6">
            @method('PUT')
            @include('admin.projects._form', ['submitLabel' => 'Save Changes'])
        </form>
    </div>
</x-admin.layout>
