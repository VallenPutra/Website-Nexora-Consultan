@csrf
<div class="grid gap-5 sm:grid-cols-2">
    <div>
        <label for="title" class="text-sm font-medium text-navy">Service title</label>
        <input id="title" name="title" value="{{ old('title', $service->title ?? '') }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="slug" class="text-sm font-medium text-navy">Slug</label>
        <input id="slug" name="slug" value="{{ old('slug', $service->slug ?? '') }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="sm:col-span-2">
        <label for="short" class="text-sm font-medium text-navy">Short description</label>
        <textarea id="short" name="short" rows="3" class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">{{ old('short', $service->short ?? '') }}</textarea>
        @error('short') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="sort_order" class="text-sm font-medium text-navy">Display order</label>
        <input id="sort_order" name="sort_order" type="number" min="0" max="999" value="{{ old('sort_order', $service->sort_order ?? 0) }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('sort_order') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <label class="flex items-center gap-2 self-end pb-2 text-sm font-medium text-navy">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $service->is_active ?? true)) class="rounded border-navy/25 text-accent focus:ring-accent/40">
        Active on public website
    </label>
</div>
<div class="mt-6 flex flex-wrap gap-3"><button type="submit" class="admin-btn-primary">{{ $submitLabel }}</button><a href="{{ route('admin.services.index') }}" class="admin-btn-secondary">Cancel</a></div>
