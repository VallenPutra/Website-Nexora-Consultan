<x-admin.layout title="Clients">
    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-accent">Business Management</p>
                <h1 class="mt-1 text-2xl font-bold text-navy">Clients</h1>
                <p class="mt-1 text-sm text-muted">Manage client contacts and account details.</p>
            </div>
            <a href="{{ route('admin.clients.create') }}" class="admin-btn-primary">
                <x-admin.icon name="plus" class="h-4 w-4" /> Add Client
            </a>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
        @endif

        <div class="admin-card overflow-hidden">
            <div class="border-b border-navy/10 p-4">
                <form method="GET" action="{{ route('admin.clients.index') }}" class="flex max-w-md items-center gap-2">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Search clients..." class="min-w-0 flex-1 rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    <button type="submit" class="admin-btn-secondary">Search</button>
                </form>
            </div>

            @if ($clients->isEmpty())
                <div class="p-5">
                    <x-admin.empty-state title="No clients yet" description="Add your first client to start building the client directory." icon="clients">
                        <a href="{{ route('admin.clients.create') }}" class="admin-btn-primary mt-6">Add First Client</a>
                    </x-admin.empty-state>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-navy/10 text-xs uppercase tracking-wide text-muted">
                            <tr>
                                <th class="px-5 py-3 font-medium">Client</th>
                                <th class="px-5 py-3 font-medium">Contact</th>
                                <th class="px-5 py-3 font-medium">Industry</th>
                                <th class="px-5 py-3 font-medium">Status</th>
                                <th class="px-5 py-3 text-right font-medium">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-navy/5">
                            @foreach ($clients as $client)
                                <tr class="hover:bg-surface/70">
                                    <td class="px-5 py-4">
                                        <a href="{{ route('admin.clients.show', $client) }}" class="font-semibold text-navy hover:text-accent">{{ $client->name }}</a>
                                        <p class="mt-0.5 text-xs text-muted">{{ $client->company ?: 'Individual client' }}</p>
                                    </td>
                                    <td class="px-5 py-4 text-muted">{{ $client->email ?: $client->phone ?: 'No contact details' }}</td>
                                    <td class="px-5 py-4 text-muted">{{ $client->industry ?: '—' }}</td>
                                    <td class="px-5 py-4"><span class="admin-badge {{ $client->status === 'active' ? 'admin-badge-success' : 'admin-badge-neutral' }}">{{ ucfirst($client->status) }}</span></td>
                                    <td class="px-5 py-4 text-right"><a href="{{ route('admin.clients.edit', $client) }}" class="text-sm font-semibold text-accent hover:text-amber-600">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="border-t border-navy/10 px-5 py-4">{{ $clients->links() }}</div>
            @endif
        </div>
    </div>
</x-admin.layout>
