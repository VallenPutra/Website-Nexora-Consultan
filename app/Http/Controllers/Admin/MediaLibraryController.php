<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaUploadRequest;
use App\Models\Insight;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $file = $request->file('file');
        $filename = $this->readableFilename($file->getClientOriginalName());
        $disk = Storage::disk('public');

        if ($disk->exists('media/'.$filename)) {
            return back()->withErrors(['file' => 'File dengan nama tersebut sudah ada. Silakan gunakan nama lain atau rename file yang lama.']);
        }

        $disk->putFileAs('media', $file, $filename);

        return redirect()->route('admin.media.index')->with('status', 'File uploaded successfully.');
    }

    public function rename(Request $request, string $path): RedirectResponse
    {
        abort_unless($this->isMediaPath($path) && Storage::disk('public')->exists($path), 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $filename = $this->readableFilename($validated['name'], pathinfo($path, PATHINFO_EXTENSION));
        $newPath = 'media/'.$filename;
        $disk = Storage::disk('public');

        if ($newPath !== $path && $disk->exists($newPath)) {
            return back()->withErrors(['name' => 'File dengan nama tersebut sudah ada.']);
        }

        if ($newPath !== $path) {
            $disk->move($path, $newPath);
            Insight::where('cover_image', $path)->update(['cover_image' => $newPath]);
        }

        return redirect()->route('admin.media.index')->with('status', 'File name updated successfully.');
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

    private function readableFilename(string $filename, string $fallbackExtension = ''): string
    {
        $baseName = pathinfo(basename($filename), PATHINFO_FILENAME);
        $extension = pathinfo(basename($filename), PATHINFO_EXTENSION) ?: $fallbackExtension;
        $baseName = preg_replace('/[^\pL\pN _-]+/u', '', $baseName) ?? '';
        $baseName = trim(preg_replace('/\s+/u', ' ', $baseName) ?? '');

        abort_if($baseName === '', 422, 'Nama file tidak valid.');

        return $baseName.($extension !== '' ? '.'.strtolower($extension) : '');
    }
}
