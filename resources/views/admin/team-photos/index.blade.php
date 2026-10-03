<x-admin.layout title="Team Group Photos">
    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div><p class="text-sm font-semibold uppercase tracking-wide text-accent">Content</p><h1 class="mt-1 text-2xl font-bold text-navy">Team Group Photos</h1><p class="mt-1 text-sm text-muted">Manage the horizontal team photo slider on the public team page.</p></div>
            <a href="{{ route('admin.team-photos.create') }}" class="admin-btn-primary"><x-admin.icon name="plus" class="h-4 w-4" /> Add Group Photo</a>
        </div>
        @if (session('status'))<div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>@endif
        @if ($photos->isEmpty())
            <x-admin.empty-state title="No group photos yet" description="Add team photos. The public page will show a slider when you add more than one." icon="media"><a href="{{ route('admin.team-photos.create') }}" class="admin-btn-primary mt-6">Add First Photo</a></x-admin.empty-state>
        @else
            <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($photos as $photo)
                    <article class="admin-card overflow-hidden">
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($photo->image_path) }}" alt="{{ $photo->title }}" class="aspect-video w-full object-cover">
                        <div class="space-y-3 p-4">
                            <div class="flex items-start justify-between gap-3"><div><h2 class="font-semibold text-navy">{{ $photo->title }}</h2><p class="mt-1 text-xs text-muted">Order {{ $photo->sort_order }}</p></div><span class="admin-badge {{ $photo->is_active ? 'admin-badge-success' : 'admin-badge-neutral' }}">{{ $photo->is_active ? 'Active' : 'Hidden' }}</span></div>
                            @if ($photo->description)<p class="text-sm leading-relaxed text-muted">{{ $photo->description }}</p>@endif
                            <div class="flex items-center justify-between border-t border-navy/10 pt-3"><a href="{{ route('admin.team-photos.edit', $photo) }}" class="text-sm font-semibold text-accent hover:text-amber-600">Edit</a><form method="POST" action="{{ route('admin.team-photos.destroy', $photo) }}" onsubmit="return confirm('Delete this team photo?')">@csrf @method('DELETE')<button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-700">Delete</button></form></div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div>{{ $photos->links() }}</div>
        @endif
    </div>
</x-admin.layout>
