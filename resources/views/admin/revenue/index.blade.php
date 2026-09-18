@php
    $formatRupiah = fn (int $n) => 'Rp'.number_format($n, 0, ',', '.');
    $statusTone = fn (string $status) => match ($status) {
        'paid' => 'admin-badge-success',
        'overdue' => 'admin-badge-danger',
        default => 'admin-badge-warning',
    };
@endphp

<x-admin.layout title="Revenue">
    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-accent">Reports</p>
                <h1 class="mt-1 text-2xl font-bold text-navy">Revenue</h1>
                <p class="mt-1 text-sm text-muted">Track invoices, payments, and outstanding balances.</p>
            </div>
            <a href="{{ route('admin.revenue.create') }}" class="admin-btn-primary"><x-admin.icon name="plus" class="h-4 w-4" /> Add Revenue Entry</a>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
        @endif

        <div class="grid gap-4 sm:grid-cols-3">
            <div class="admin-card p-5">
                <p class="text-xs uppercase tracking-wide text-muted">Paid</p>
                <p class="mt-1.5 text-2xl font-bold text-navy">{{ $formatRupiah($totals['paid']) }}</p>
            </div>
            <div class="admin-card p-5">
                <p class="text-xs uppercase tracking-wide text-muted">Pending</p>
                <p class="mt-1.5 text-2xl font-bold text-navy">{{ $formatRupiah($totals['pending']) }}</p>
            </div>
            <div class="admin-card p-5">
                <p class="text-xs uppercase tracking-wide text-muted">Overdue</p>
                <p class="mt-1.5 text-2xl font-bold text-navy">{{ $formatRupiah($totals['overdue']) }}</p>
            </div>
        </div>

        <div class="admin-card overflow-hidden">
            <div class="border-b border-navy/10 p-4">
                <form method="GET" action="{{ route('admin.revenue.index') }}" class="flex flex-wrap items-center gap-2">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Search description or client..." class="min-w-0 flex-1 rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    <select name="status" class="rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <option value="">All statuses</option>
                        @foreach (['pending' => 'Pending', 'paid' => 'Paid', 'overdue' => 'Overdue'] as $value => $label)
                            <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="admin-btn-secondary">Filter</button>
                </form>
            </div>

            @if ($revenues->isEmpty())
                <div class="p-5">
                    <x-admin.empty-state title="No revenue entries yet" description="Record an invoice or payment to start tracking revenue." icon="revenue">
                        <a href="{{ route('admin.revenue.create') }}" class="admin-btn-primary mt-6">Add First Revenue Entry</a>
                    </x-admin.empty-state>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-navy/10 text-xs uppercase tracking-wide text-muted">
                            <tr>
                                <th class="px-5 py-3 font-medium">Description</th>
                                <th class="px-5 py-3 font-medium">Client</th>
                                <th class="px-5 py-3 font-medium">Amount</th>
                                <th class="px-5 py-3 font-medium">Status</th>
                                <th class="px-5 py-3 font-medium">Invoice Date</th>
                                <th class="px-5 py-3 text-right font-medium">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-navy/5">
                            @foreach ($revenues as $revenue)
                                <tr class="hover:bg-surface/70">
                                    <td class="px-5 py-4">
                                        <a href="{{ route('admin.revenue.show', $revenue) }}" class="font-semibold text-navy hover:text-accent">{{ $revenue->description }}</a>
                                        <p class="mt-0.5 text-xs text-muted">{{ $revenue->project?->name ?? 'No project assigned' }}</p>
                                    </td>
                                    <td class="px-5 py-4 text-muted">{{ $revenue->client->company ?: $revenue->client->name }}</td>
                                    <td class="px-5 py-4 font-medium text-navy whitespace-nowrap">{{ $formatRupiah($revenue->amount) }}</td>
                                    <td class="px-5 py-4"><span class="admin-badge {{ $statusTone($revenue->status) }}">{{ ucfirst($revenue->status) }}</span></td>
                                    <td class="px-5 py-4 whitespace-nowrap text-muted">{{ $revenue->invoice_date->format('d M Y') }}</td>
                                    <td class="px-5 py-4 text-right whitespace-nowrap">
                                        @if ($revenue->status !== 'paid')
                                            <form method="POST" action="{{ route('admin.revenue.mark-paid', $revenue) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">Mark Paid</button>
                                            </form>
                                            <span class="mx-1.5 text-navy/15">|</span>
                                        @endif
                                        <a href="{{ route('admin.revenue.edit', $revenue) }}" class="text-sm font-semibold text-accent hover:text-amber-600">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="border-t border-navy/10 px-5 py-4">{{ $revenues->links() }}</div>
            @endif
        </div>
    </div>
</x-admin.layout>
