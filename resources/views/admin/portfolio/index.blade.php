<x-admin.layout title="Portfolio">
    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div><p class="text-sm font-semibold uppercase tracking-wide text-accent">Content</p><h1 class="mt-1 text-2xl font-bold text-navy">Portfolio</h1><p class="mt-1 text-sm text-muted">Manage the project cards and photos on the public portfolio page.</p></div>
            <a href="{{ route('admin.portfolio.create') }}" class="admin-btn-primary"><x-admin.icon name="plus" class="h-4 w-4" /> Add Portfolio Item</a>
        </div>
        @if (session('status'))<div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>@endif
        <div class="admin-card overflow-hidden">
            <div class="border-b border-navy/10 p-4">
                <form method="GET" action="{{ route('admin.portfolio.index') }}" class="flex flex-wrap gap-2">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Search portfolio..." class="min-w-48 flex-1 rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    <select name="category" class="rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <option value="">All categories</option>
                        @foreach ($categories as $value => $label)
                            <option value="{{ $value }}" @selected(request('category') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="admin-btn-secondary">Filter</button>
                </form>
            </div>
            @if ($portfolioItems->isEmpty())
                <div class="p-5"><x-admin.empty-state title="No portfolio items yet" description="Add a portfolio card and project photo to get started." icon="projects"><a href="{{ route('admin.portfolio.create') }}" class="admin-btn-primary mt-6">Add First Item</a></x-admin.empty-state></div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-navy/10 text-xs uppercase tracking-wide text-muted"><tr><th class="px-5 py-3 font-medium">Project</th><th class="px-5 py-3 font-medium">Category</th><th class="px-5 py-3 font-medium">Order</th><th class="px-5 py-3 text-right font-medium">Action</th></tr></thead>
                        <tbody class="divide-y divide-navy/5">
                            @foreach ($portfolioItems as $portfolioItem)
                                <tr class="hover:bg-surface/70">
                                    <td class="px-5 py-4"><div class="flex items-center gap-3">@if ($portfolioItem->image_path)<img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($portfolioItem->image_path) }}" alt="" class="h-12 w-20 rounded-md object-cover">@endif<div><a href="{{ route('admin.portfolio.show', $portfolioItem) }}" class="font-semibold text-navy hover:text-accent">{{ $portfolioItem->name_id }}</a><p class="mt-0.5 text-xs text-muted">{{ $portfolioItem->work_id }}</p></div></div></td>
                                    <td class="px-5 py-4 text-muted">{{ $categories[$portfolioItem->category] }}</td>
                                    <td class="px-5 py-4 text-muted">{{ $portfolioItem->sort_order }}</td>
                                    <td class="px-5 py-4 text-right"><a href="{{ route('admin.portfolio.edit', $portfolioItem) }}" class="text-sm font-semibold text-accent hover:text-amber-600">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="border-t border-navy/10 px-5 py-4">{{ $portfolioItems->links() }}</div>
            @endif
        </div>
    </div>
</x-admin.layout>
