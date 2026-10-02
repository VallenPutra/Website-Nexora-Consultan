<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $requestedCategory = $request->query('category');
        $activeCategory = is_string($requestedCategory) && array_key_exists($requestedCategory, PortfolioItem::CATEGORIES)
            ? $requestedCategory
            : null;

        $portfolioItems = PortfolioItem::query()
            ->when($activeCategory, fn ($query, string $category) => $query->where('category', $category))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();

        return view('pages.company.portfolio', [
            'portfolioItems' => $portfolioItems,
            'categories' => PortfolioItem::CATEGORIES,
            'activeCategory' => $activeCategory,
        ]);
    }
}
