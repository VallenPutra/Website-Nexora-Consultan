<x-admin.layout title="Add Client">
    <div class="mx-auto max-w-3xl space-y-6">
        <div>
            <a href="{{ route('admin.clients.index') }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Clients</a>
            <h1 class="mt-3 text-2xl font-bold text-navy">Add Client</h1>
            <p class="mt-1 text-sm text-muted">Create a client record for your consulting business.</p>
        </div>

        <form method="POST" action="{{ route('admin.clients.store') }}" class="admin-card p-5 sm:p-6">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('admin.clients._form', ['submitLabel' => 'Create Client'])
        </form>
    </div>
</x-admin.layout>
