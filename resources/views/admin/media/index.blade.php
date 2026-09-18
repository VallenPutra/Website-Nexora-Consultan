<x-admin.layout title="Media Library">
    <div class="mx-auto max-w-7xl space-y-6">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-accent">Content</p>
            <h1 class="mt-1 text-2xl font-bold text-navy">Media Library</h1>
            <p class="mt-1 text-sm text-muted">Upload and manage images and documents used by the website.</p>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $errors->first('file') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="admin-card flex flex-col gap-4 p-5 sm:flex-row sm:items-end sm:justify-between">
            @csrf
            <div class="min-w-0 flex-1">
                <label for="file" class="text-sm font-medium text-navy">Choose a file</label>
                <input id="file" name="file" type="file" required class="mt-1.5 block w-full rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm text-muted file:mr-4 file:rounded-md file:border-0 file:bg-surface file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-navy">
                <p class="mt-1.5 text-xs text-muted">JPG, PNG, WebP, GIF, SVG, PDF, DOC, DOCX, XLS, or XLSX. Maximum 10 MB.</p>
            </div>
            <button type="submit" class="admin-btn-primary shrink-0"><x-admin.icon name="plus" class="h-4 w-4" /> Upload File</button>
        </form>

        @if ($files->isEmpty())
            <x-admin.empty-state title="No media files yet" description="Upload your first image or document to start the library." icon="media" />
        @else
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($files as $file)
                    <article class="admin-card overflow-hidden">
                        <div class="flex aspect-4/3 items-center justify-center bg-surface p-4">
                            @if (str_starts_with($file['mime'], 'image/'))
                                <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" class="h-full w-full object-contain">
                            @else
                                <x-admin.icon name="media" class="h-12 w-12 text-muted" />
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="truncate text-sm font-semibold text-navy" title="{{ $file['name'] }}">{{ $file['name'] }}</p>
                            <p class="mt-1 text-xs text-muted">{{ strtoupper($file['mime']) }} &middot; {{ number_format($file['size'] / 1024, 1) }} KB</p>
                            <div class="mt-4 flex items-center justify-between gap-3">
                                <a href="{{ route('admin.media.download', ['path' => $file['path']]) }}" class="text-sm font-semibold text-accent hover:text-amber-600">Download</a>
                                <form method="POST" action="{{ route('admin.media.destroy', ['path' => $file['path']]) }}" onsubmit="return confirm('Delete this file?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</x-admin.layout>
