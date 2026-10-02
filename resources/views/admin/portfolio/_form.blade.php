@csrf

<div class="grid gap-5 sm:grid-cols-2">
    <div>
        <label for="name_id" class="text-sm font-medium text-navy">Project name (Indonesia)</label>
        <input id="name_id" name="name_id" value="{{ old('name_id', $portfolioItem->name_id ?? '') }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('name_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="name_en" class="text-sm font-medium text-navy">Project name (English)</label>
        <input id="name_en" name="name_en" value="{{ old('name_en', $portfolioItem->name_en ?? '') }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('name_en') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="sm:col-span-2">
        <label for="category" class="text-sm font-medium text-navy">Category</label>
        <select id="category" name="category" required class="mt-1.5 w-full rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
            @foreach ($categories as $value => $label)
                <option value="{{ $value }}" @selected(old('category', $portfolioItem->category ?? 'website') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('category') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="work_id" class="text-sm font-medium text-navy">Project summary (Indonesia)</label>
        <textarea id="work_id" name="work_id" rows="3" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">{{ old('work_id', $portfolioItem->work_id ?? '') }}</textarea>
        @error('work_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="work_en" class="text-sm font-medium text-navy">Project summary (English)</label>
        <textarea id="work_en" name="work_en" rows="3" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">{{ old('work_en', $portfolioItem->work_en ?? '') }}</textarea>
        @error('work_en') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="sort_order" class="text-sm font-medium text-navy">Display order</label>
        <input id="sort_order" name="sort_order" type="number" min="0" max="999" value="{{ old('sort_order', $portfolioItem->sort_order ?? 0) }}" required class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
        @error('sort_order') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="image" class="text-sm font-medium text-navy">Project photo</label>
        <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp" @required(!isset($portfolioItem)) class="mt-1.5 block w-full rounded-lg border border-navy/15 bg-white px-3 py-2 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-surface file:px-3 file:py-2 file:text-sm file:font-semibold file:text-navy">
        <p class="mt-1.5 text-xs text-muted">JPG, PNG, or WEBP, maximum 5 MB. Upload a replacement to change the current photo.</p>
        @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        @if (isset($portfolioItem) && $portfolioItem->image_path)
            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($portfolioItem->image_path) }}" alt="{{ $portfolioItem->localizedName() }}" class="mt-3 aspect-video w-full max-w-sm rounded-lg object-cover">
        @endif
    </div>
</div>

<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="admin-btn-primary">{{ $submitLabel }}</button>
    <a href="{{ route('admin.portfolio.index') }}" class="admin-btn-secondary">Cancel</a>
</div>
