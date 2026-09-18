<x-admin.layout title="Consultation Requests">
    <div class="mx-auto max-w-7xl space-y-6">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-accent">Communication</p>
            <h1 class="mt-1 text-2xl font-bold text-navy">Consultation Requests</h1>
            <p class="mt-1 text-sm text-muted">Review and manage requests submitted through the public contact form.</p>
        </div>
        @if (session('status'))<div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>@endif
        <div class="admin-card overflow-hidden">
            <div class="flex flex-col gap-3 border-b border-navy/10 p-4 sm:flex-row sm:items-center sm:justify-between">
                <form method="GET" action="{{ route('admin.consultation-requests.index') }}" class="flex max-w-md gap-2"><input type="search" name="q" value="{{ request('q') }}" placeholder="Search requests..." class="min-w-0 flex-1 rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent"><button type="submit" class="admin-btn-secondary">Search</button></form>
                <select onchange="this.form.submit()" form="status-filter" class="rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm text-navy"><option value="">All statuses</option>@foreach (['new' => 'New', 'in_review' => 'In Review', 'contacted' => 'Contacted', 'converted' => 'Converted', 'closed' => 'Closed'] as $value => $label)<option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>@endforeach</select>
                <form id="status-filter" method="GET" action="{{ route('admin.consultation-requests.index') }}"><input type="hidden" name="q" value="{{ request('q') }}"></form>
            </div>
            @if ($requests->isEmpty())<div class="p-5"><x-admin.empty-state title="No consultation requests" description="Requests submitted through the public contact form will appear here." icon="requests" /></div>@else
                <div class="overflow-x-auto"><table class="w-full text-left text-sm"><thead class="border-b border-navy/10 text-xs uppercase tracking-wide text-muted"><tr><th class="px-5 py-3 font-medium">Contact</th><th class="px-5 py-3 font-medium">Company</th><th class="px-5 py-3 font-medium">Service</th><th class="px-5 py-3 font-medium">Received</th><th class="px-5 py-3 font-medium">Status</th><th class="px-5 py-3 text-right font-medium">Action</th></tr></thead><tbody class="divide-y divide-navy/5">@foreach ($requests as $requestItem)<tr class="hover:bg-surface/70"><td class="px-5 py-4"><a href="{{ route('admin.consultation-requests.show', $requestItem) }}" class="font-semibold text-navy hover:text-accent">{{ $requestItem->name }}</a><p class="mt-0.5 text-xs text-muted">{{ $requestItem->email }}</p></td><td class="px-5 py-4 text-muted">{{ $requestItem->company ?: '—' }}</td><td class="px-5 py-4 text-muted">{{ $requestItem->service }}</td><td class="px-5 py-4 whitespace-nowrap text-muted">{{ $requestItem->created_at->format('d M Y') }}</td><td class="px-5 py-4"><x-admin.status-badge :status="ucwords(str_replace('_', ' ', $requestItem->status))" /></td><td class="px-5 py-4 text-right"><a href="{{ route('admin.consultation-requests.show', $requestItem) }}" class="text-sm font-semibold text-accent hover:text-amber-600">View</a></td></tr>@endforeach</tbody></table></div><div class="border-t border-navy/10 px-5 py-4">{{ $requests->links() }}</div>
            @endif
        </div>
    </div>
</x-admin.layout>
