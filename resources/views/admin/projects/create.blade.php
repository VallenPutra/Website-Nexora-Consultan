<x-admin.layout title="Add Project">
    <div class="mx-auto max-w-3xl space-y-6">
        <div><a href="{{ route('admin.projects.index') }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Projects</a><h1 class="mt-3 text-2xl font-bold text-navy">Add Project</h1><p class="mt-1 text-sm text-muted">Create a project and connect it to a client.</p></div>
        <form method="POST" action="{{ route('admin.projects.store') }}" class="admin-card p-5 sm:p-6">
            @include('admin.projects._form', ['submitLabel' => 'Create Project'])
        </form>
    </div>
</x-admin.layout>
