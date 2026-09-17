<?php

namespace App\Http\Controllers;

use App\Support\SiteContent;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('pages.services.index', [
            'services' => SiteContent::services(),
        ]);
    }

    public function show(string $slug): View
    {
        $services = SiteContent::services();

        abort_unless(array_key_exists($slug, $services), Response::HTTP_NOT_FOUND);

        return view('pages.services.show', [
            'slug' => $slug,
            'service' => $services[$slug],
            'allServices' => $services,
        ]);
    }
}
