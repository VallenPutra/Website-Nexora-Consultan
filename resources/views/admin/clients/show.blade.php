<x-admin.layout title="Client Details">
    <div class="mx-auto max-w-4xl space-y-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <a href="{{ route('admin.clients.index') }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Clients</a>
                <h1 class="mt-3 text-2xl font-bold text-navy">{{ $client->name }}</h1>
                <p class="mt-1 text-sm text-muted">{{ $client->company ?: 'Individual client' }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.clients.edit', $client) }}" class="admin-btn-primary">Edit Client</a>
                <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Delete this client?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin-btn-secondary text-red-600 hover:border-red-300 hover:text-red-700">Delete</button>
                </form>
            </div>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
        @endif

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="admin-card p-5 lg:col-span-2">
                <h2 class="text-base font-semibold text-navy">Contact Details</h2>
                <dl class="mt-5 grid gap-5 sm:grid-cols-2">
                    <div><dt class="text-xs uppercase tracking-wide text-muted">Email</dt><dd class="mt-1 text-sm text-charcoal">{{ $client->email ?: '—' }}</dd></div>
                    <div><dt class="text-xs uppercase tracking-wide text-muted">Phone</dt><dd class="mt-1 text-sm text-charcoal">{{ $client->phone ?: '—' }}</dd></div>
                    <div><dt class="text-xs uppercase tracking-wide text-muted">Industry</dt><dd class="mt-1 text-sm text-charcoal">{{ $client->industry ?: '—' }}</dd></div>
                    <div><dt class="text-xs uppercase tracking-wide text-muted">Added</dt><dd class="mt-1 text-sm text-charcoal">{{ $client->created_at->format('d M Y') }}</dd></div>
                </dl>
            </div>
            <div class="admin-card p-5">
                <h2 class="text-base font-semibold text-navy">Status</h2>
                <span class="admin-badge {{ $client->status === 'active' ? 'admin-badge-success' : 'admin-badge-neutral' }} mt-4">{{ ucfirst($client->status) }}</span>
            </div>
        </div>

        <div class="admin-card p-5">
            <h2 class="text-base font-semibold text-navy">Notes</h2>
            <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-muted">{{ $client->notes ?: 'No notes have been added.' }}</p>
        </div>
    </div>
</x-admin.layout>
