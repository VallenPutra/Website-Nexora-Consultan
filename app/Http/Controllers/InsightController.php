<?php

namespace App\Http\Controllers;

use App\Support\SiteContent;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class InsightController extends Controller
{
    public function index(Request $request): View
    {
        $articles = SiteContent::insights();

        $category = $request->query('category');
        $search = $request->query('q');

        $filtered = collect($articles)->when($category, function ($items) use ($category) {
            return $items->filter(fn ($article) => $article['category'] === $category);
        })->when($search, function ($items) use ($search) {
            return $items->filter(fn ($article) => str_contains(strtolower($article['title']), strtolower($search))
                || str_contains(strtolower($article['excerpt']), strtolower($search)));
        });

        $categories = collect($articles)->pluck('category')->unique()->values();

        return view('pages.insights.index', [
            'articles' => $filtered,
            'featured' => collect($articles)->first(),
            'featuredSlug' => collect($articles)->keys()->first(),
            'categories' => $categories,
            'activeCategory' => $category,
            'search' => $search,
        ]);
    }

    public function show(string $slug): View
    {
        $articles = SiteContent::insights();

        abort_unless(array_key_exists($slug, $articles), Response::HTTP_NOT_FOUND);

        $related = collect($articles)
            ->except($slug)
            ->take(3);

        return view('pages.insights.show', [
            'slug' => $slug,
            'article' => $articles[$slug],
            'related' => $related,
        ]);
    }
}
