@php
    $formatRupiah = fn (int $n) => 'Rp'.number_format($n, 0, ',', '.');
    $statusTone = match ($revenue->status) {
        'paid' => 'admin-badge-success',
        'overdue' => 'admin-badge-danger',
        default => 'admin-badge-warning',
    };
@endphp

<x-admin.layout title="Revenue Entry">
    <div class="mx-auto max-w-4xl space-y-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <a href="{{ route('admin.revenue.index') }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Revenue</a>
                <h1 class="mt-3 text-2xl font-bold text-navy">{{ $revenue->description }}</h1>
                <p class="mt-1 text-sm text-muted">{{ $revenue->client->company ?: $revenue->client->name }}</p>
            </div>
            <div class="flex gap-3">
                @if ($revenue->status !== 'paid')
                    <form method="POST" action="{{ route('admin.revenue.mark-paid', $revenue) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="admin-btn-secondary text-emerald-600 hover:border-emerald-300 hover:text-emerald-700">Mark as Paid</button>
                    </form>
                @endif
                <a href="{{ route('admin.revenue.edit', $revenue) }}" class="admin-btn-primary">Edit Entry</a>
                <form method="POST" action="{{ route('admin.revenue.destroy', $revenue) }}" onsubmit="return confirm('Delete this revenue entry?')">
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
                <h2 class="text-base font-semibold text-navy">Entry Details</h2>
                <dl class="mt-5 grid gap-5 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-muted">Client</dt>
                        <dd class="mt-1 text-sm text-charcoal">{{ $revenue->client->name }}{{ $revenue->client->company ? ' — '.$revenue->client->company : '' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-muted">Project</dt>
                        <dd class="mt-1 text-sm text-charcoal">
                            @if ($revenue->project)
                                <a href="{{ route('admin.projects.show', $revenue->project) }}" class="text-accent hover:text-amber-600">{{ $revenue->project->name }}</a>
                            @else
                                No project assigned
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-muted">Invoice date</dt>
                        <dd class="mt-1 text-sm text-charcoal">{{ $revenue->invoice_date->format('d M Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-muted">Paid on</dt>
                        <dd class="mt-1 text-sm text-charcoal">{{ $revenue->paid_at?->format('d M Y') ?: '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="admin-card p-5">
                <h2 class="text-base font-semibold text-navy">Amount</h2>
                <p class="mt-4 text-3xl font-bold text-navy">{{ $formatRupiah($revenue->amount) }}</p>
                <span class="admin-badge {{ $statusTone }} mt-5">{{ ucfirst($revenue->status) }}</span>
            </div>
        </div>
    </div>
</x-admin.layout>
