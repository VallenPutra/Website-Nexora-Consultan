<x-admin.layout title="Edit Client">
    <div class="mx-auto max-w-3xl space-y-6">
        <div>
            <a href="{{ route('admin.clients.show', $client) }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Client</a>
            <h1 class="mt-3 text-2xl font-bold text-navy">Edit Client</h1>
            <p class="mt-1 text-sm text-muted">Update {{ $client->name }}'s account details.</p>
        </div>

        <form method="POST" action="{{ route('admin.clients.update', $client) }}" class="admin-card p-5 sm:p-6">
            @method('PUT')
            @include('admin.clients._form', ['submitLabel' => 'Save Changes'])
        </form>
    </div>
</x-admin.layout>
