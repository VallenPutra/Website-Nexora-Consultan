<x-admin.layout title="Add Revenue Entry">
    <div class="mx-auto max-w-3xl space-y-6">
        <div>
            <a href="{{ route('admin.revenue.index') }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Revenue</a>
            <h1 class="mt-3 text-2xl font-bold text-navy">Add Revenue Entry</h1>
            <p class="mt-1 text-sm text-muted">Record an invoice or payment against a client.</p>
        </div>
        <form method="POST" action="{{ route('admin.revenue.store') }}" class="admin-card p-5 sm:p-6">
            @include('admin.revenue._form', ['submitLabel' => 'Create Entry'])
        </form>
    </div>
</x-admin.layout>
