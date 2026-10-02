<x-admin.layout title="Edit Portfolio Item">
    <div class="mx-auto max-w-4xl space-y-6">
        <div>
            <a href="{{ route('admin.portfolio.show', $portfolioItem) }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Portfolio Item</a>
            <h1 class="mt-3 text-2xl font-bold text-navy">Edit Portfolio Item</h1>
            <p class="mt-1 text-sm text-muted">Update {{ $portfolioItem->name_en }}.</p>
        </div>
        @if (session('status'))<div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>@endif
        <form method="POST" action="{{ route('admin.portfolio.update', $portfolioItem) }}" enctype="multipart/form-data" class="admin-card p-5 sm:p-6">
            @method('PUT')
            @include('admin.portfolio._form', ['submitLabel' => 'Save Changes'])
        </form>
    </div>
</x-admin.layout>
