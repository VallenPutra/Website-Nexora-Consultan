<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InsightRequest;
use App\Models\Insight;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InsightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $insights = Insight::query()
            ->when(request('q'), fn ($query, $search) => $query->where(function ($query) use ($search): void {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            }))
            ->latest('published_at')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('admin.insights.index', compact('insights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.insights.create', ['mediaFiles' => $this->mediaFiles()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsightRequest $request): RedirectResponse
    {
        $insight = Insight::create($request->validated() + ['is_published' => $request->boolean('is_published')]);

        return redirect()->route('admin.insights.show', $insight)->with('status', 'Insight created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insight $insight): View
    {
        return view('admin.insights.show', compact('insight'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insight $insight): View
    {
        return view('admin.insights.edit', ['insight' => $insight, 'mediaFiles' => $this->mediaFiles()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InsightRequest $request, Insight $insight): RedirectResponse
    {
        $insight->update($request->validated() + ['is_published' => $request->boolean('is_published')]);

        return redirect()->route('admin.insights.show', $insight)->with('status', 'Insight updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insight $insight): RedirectResponse
    {
        $insight->delete();

        return redirect()->route('admin.insights.index')->with('status', 'Insight deleted successfully.');
    }

    /**
     * Return image assets that can be used as public article covers.
     *
     * @return array<int, array{path: string, name: string, url: string}>
     */
    private function mediaFiles(): array
    {
        $disk = Storage::disk('public');

        return collect($disk->files('media'))
            ->filter(fn (string $path): bool => str_starts_with((string) $disk->mimeType($path), 'image/'))
            ->map(fn (string $path): array => [
                'path' => $path,
                'name' => basename($path),
                'url' => $disk->url($path),
            ])
            ->values()
            ->all();
    }
}
