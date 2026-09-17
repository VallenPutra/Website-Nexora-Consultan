<?php

namespace App\Http\Controllers;

use App\Support\SiteContent;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class IndustryController extends Controller
{
    public function index(): View
    {
        return view('pages.industries.index', [
            'industries' => SiteContent::industries(),
        ]);
    }

    public function show(string $slug): View
    {
        $industries = SiteContent::industries();

        abort_unless(array_key_exists($slug, $industries), Response::HTTP_NOT_FOUND);

        return view('pages.industries.show', [
            'slug' => $slug,
            'industry' => $industries[$slug],
            'allIndustries' => $industries,
        ]);
    }
}
