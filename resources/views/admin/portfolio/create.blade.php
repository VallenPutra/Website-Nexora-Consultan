<x-admin.layout title="Add Portfolio Item">
    <div class="mx-auto max-w-4xl space-y-6">
        <div>
            <a href="{{ route('admin.portfolio.index') }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Portfolio</a>
            <h1 class="mt-3 text-2xl font-bold text-navy">Add Portfolio Item</h1>
            <p class="mt-1 text-sm text-muted">Add a project card to the public portfolio.</p>
        </div>
        <form method="POST" action="{{ route('admin.portfolio.store') }}" enctype="multipart/form-data" class="admin-card p-5 sm:p-6">
            @include('admin.portfolio._form', ['submitLabel' => 'Create Portfolio Item'])
        </form>
    </div>
</x-admin.layout>
