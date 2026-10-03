@csrf
<div class="grid gap-5 sm:grid-cols-2">
    <div>
        <label for="title" class="text-sm font-medium text-navy">Photo title</label>
        <input id="title" name="title" value="{{ old('title', $photo->title ?? '') }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="sort_order" class="text-sm font-medium text-navy">Display order</label>
        <input id="sort_order" name="sort_order" type="number" min="0" max="999" value="{{ old('sort_order', $photo->sort_order ?? 0) }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('sort_order')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="description" class="text-sm font-medium text-navy">Description</label>
        <textarea id="description" name="description" rows="3" class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">{{ old('description', $photo->description ?? '') }}</textarea>
        @error('description')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>
    <div class="sm:col-span-2">
        <label for="image" class="text-sm font-medium text-navy">Team group photo</label>
        <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp" @required(!isset($photo)) class="mt-1.5 block w-full rounded-lg border border-navy/15 bg-white px-3 py-2 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-surface file:px-3 file:py-2 file:text-sm file:font-semibold file:text-navy">
        <p class="mt-1.5 text-xs text-muted">JPG, PNG, or WebP, maximum 10 MB. Add more than one photo to enable the horizontal slider.</p>
        @error('image')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        @if (isset($photo))<img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($photo->image_path) }}" alt="{{ $photo->title }}" class="mt-3 aspect-video w-full max-w-xl rounded-lg object-cover">@endif
    </div>
    <label class="flex items-center gap-2 text-sm font-medium text-navy"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $photo->is_active ?? true)) class="rounded border-navy/25 text-accent focus:ring-accent/40"> Show on public team page</label>
</div>
<div class="mt-6 flex flex-wrap gap-3"><button type="submit" class="admin-btn-primary">{{ $submitLabel }}</button><a href="{{ route('admin.team-photos.index') }}" class="admin-btn-secondary">Cancel</a></div>
