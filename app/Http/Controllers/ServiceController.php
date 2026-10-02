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
        $nitServices = collect(__('site.home.nit_services'))->keyBy('slug');

        if ($nitServices->has($slug)) {
            return view('pages.services.nit-show', [
                'slug' => $slug,
                'service' => $nitServices->get($slug),
            ]);
        }

        $services = SiteContent::services();

        abort_unless(array_key_exists($slug, $services), Response::HTTP_NOT_FOUND);

        return view('pages.services.show', [
            'slug' => $slug,
            'service' => $services[$slug],
            'allServices' => $services,
        ]);
    }

    public function odooCategory(string $category): View
    {
        $service = SiteContent::services()['erp-odoo'] ?? null;
        abort_unless($service !== null, Response::HTTP_NOT_FOUND);

        $categoryContent = collect($service['odoo']['categories'] ?? [])
            ->firstWhere('slug', $category);
        abort_unless($categoryContent !== null, Response::HTTP_NOT_FOUND);

        return view('pages.services.odoo-category', [
            'service' => $service,
            'category' => $categoryContent,
        ]);
    }
}
