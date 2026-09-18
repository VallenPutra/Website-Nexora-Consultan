<x-admin.layout title="Edit Revenue Entry">
    <div class="mx-auto max-w-3xl space-y-6">
        <div>
            <a href="{{ route('admin.revenue.show', $revenue) }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Entry</a>
            <h1 class="mt-3 text-2xl font-bold text-navy">Edit Revenue Entry</h1>
            <p class="mt-1 text-sm text-muted">{{ $revenue->description }}</p>
        </div>
        <form method="POST" action="{{ route('admin.revenue.update', $revenue) }}" class="admin-card p-5 sm:p-6">
            @method('PUT')
            @include('admin.revenue._form', ['submitLabel' => 'Save Changes'])
        </form>
    </div>
</x-admin.layout>
