<x-admin.layout title="Portfolio Details">
    <div class="mx-auto max-w-5xl space-y-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <a href="{{ route('admin.portfolio.index') }}" class="text-sm font-medium text-muted hover:text-accent">&larr; Back to Portfolio</a>
                <h1 class="mt-3 text-2xl font-bold text-navy">{{ $portfolioItem->name_en }}</h1>
                <p class="mt-1 text-sm text-muted">{{ $categories[$portfolioItem->category] }} &middot; {{ $portfolioItem->work_en }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.portfolio.edit', $portfolioItem) }}" class="admin-btn-primary">Edit Item</a>
                <form method="POST" action="{{ route('admin.portfolio.destroy', $portfolioItem) }}" onsubmit="return confirm('Delete this portfolio item?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin-btn-secondary text-red-600 hover:border-red-300 hover:text-red-700">Delete</button>
                </form>
            </div>
        </div>
        @if (session('status'))<div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>@endif
        <div class="admin-card grid gap-6 p-5 sm:grid-cols-2 sm:p-6">
            @if ($portfolioItem->image_path)
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($portfolioItem->image_path) }}" alt="{{ $portfolioItem->name_en }}" class="aspect-video w-full rounded-lg object-cover sm:col-span-2">
            @endif
            <div><p class="text-xs font-semibold uppercase tracking-wide text-muted">Indonesia</p><p class="mt-2 text-lg font-semibold text-navy">{{ $portfolioItem->name_id }}</p><p class="mt-2 text-sm text-muted">{{ $portfolioItem->work_id }}</p></div>
            <div><p class="text-xs font-semibold uppercase tracking-wide text-muted">English</p><p class="mt-2 text-lg font-semibold text-navy">{{ $portfolioItem->name_en }}</p><p class="mt-2 text-sm text-muted">{{ $portfolioItem->work_en }}</p></div>
            <div><p class="text-xs font-semibold uppercase tracking-wide text-muted">Category</p><p class="mt-2 text-sm text-navy">{{ $categories[$portfolioItem->category] }}</p></div>
            <div><p class="text-xs font-semibold uppercase tracking-wide text-muted">Display order</p><p class="mt-2 text-sm text-navy">{{ $portfolioItem->sort_order }}</p></div>
        </div>
    </div>
</x-admin.layout>
