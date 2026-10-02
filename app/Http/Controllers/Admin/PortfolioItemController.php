<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortfolioItemRequest;
use App\Models\PortfolioItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PortfolioItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $portfolioItems = PortfolioItem::query()
            ->when(request('q'), fn ($query, $search) => $query->where(function ($query) use ($search): void {
                $query->where('name_id', 'like', "%{$search}%")
                    ->orWhere('name_en', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            }))
            ->when(request('category'), fn ($query, $category) => $query->where('category', $category))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();

        return view('admin.portfolio.index', [
            'portfolioItems' => $portfolioItems,
            'categories' => PortfolioItem::CATEGORIES,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.portfolio.create', ['categories' => PortfolioItem::CATEGORIES]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PortfolioItemRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['image_path'] = $request->file('image')->store('portfolio', 'public');
        unset($validated['image']);

        $portfolioItem = PortfolioItem::create($validated);

        return redirect()->route('admin.portfolio.show', $portfolioItem)->with('status', 'Portfolio item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PortfolioItem $portfolioItem): View
    {
        return view('admin.portfolio.show', [
            'portfolioItem' => $portfolioItem,
            'categories' => PortfolioItem::CATEGORIES,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PortfolioItem $portfolioItem): View
    {
        return view('admin.portfolio.edit', [
            'portfolioItem' => $portfolioItem,
            'categories' => PortfolioItem::CATEGORIES,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PortfolioItemRequest $request, PortfolioItem $portfolioItem): RedirectResponse
    {
        $validated = $request->validated();
        $oldImagePath = null;

        if ($request->hasFile('image')) {
            $oldImagePath = $portfolioItem->image_path;
            $validated['image_path'] = $request->file('image')->store('portfolio', 'public');
        }

        unset($validated['image']);
        $portfolioItem->update($validated);

        if ($oldImagePath !== null) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()->route('admin.portfolio.show', $portfolioItem)->with('status', 'Portfolio item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioItem $portfolioItem): RedirectResponse
    {
        $imagePath = $portfolioItem->image_path;
        $portfolioItem->delete();

        if ($imagePath !== null) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()->route('admin.portfolio.index')->with('status', 'Portfolio item deleted successfully.');
    }
}
