<?php

namespace App\Http\Controllers;

use App\Support\SiteContent;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class SolutionController extends Controller
{
    public function index(): View
    {
        return view('pages.solutions.index', [
            'solutions' => SiteContent::solutions(),
        ]);
    }

    public function show(string $slug): View
    {
        $solutions = SiteContent::solutions();

        abort_unless(array_key_exists($slug, $solutions), Response::HTTP_NOT_FOUND);

        return view('pages.solutions.show', [
            'slug' => $slug,
            'solution' => $solutions[$slug],
            'allSolutions' => $solutions,
        ]);
    }
}
