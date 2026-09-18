<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaUploadRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MediaLibraryController extends Controller
{
    public function index(): View
    {
        $disk = Storage::disk('public');
        $files = collect($disk->files('media'))
            ->sortByDesc(fn (string $path): int => $disk->lastModified($path))
            ->map(fn (string $path): array => [
                'path' => $path,
                'name' => basename($path),
                'size' => $disk->size($path),
                'mime' => $disk->mimeType($path),
                'url' => $disk->url($path),
                'last_modified' => $disk->lastModified($path),
            ])
            ->values();

        return view('admin.media.index', compact('files'));
    }

    public function store(MediaUploadRequest $request): RedirectResponse
    {
        $request->file('file')->store('media', 'public');

        return redirect()->route('admin.media.index')->with('status', 'File uploaded successfully.');
    }

    public function download(string $path): StreamedResponse
    {
        abort_unless($this->isMediaPath($path) && Storage::disk('public')->exists($path), 404);

        return Storage::disk('public')->download($path);
    }

    public function destroy(string $path): RedirectResponse
    {
        abort_unless($this->isMediaPath($path) && Storage::disk('public')->exists($path), 404);

        Storage::disk('public')->delete($path);

        return redirect()->route('admin.media.index')->with('status', 'File deleted successfully.');
    }

    private function isMediaPath(string $path): bool
    {
        return str_starts_with($path, 'media/') && ! str_contains($path, '..');
    }
}
