<?php

namespace App\Http\Controllers;

use App\Support\SiteContent;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = [
            route('home'),
            route('solutions.index'),
            route('services.index'),
            route('industries.index'),
            route('insights.index'),
            route('company.about'),
            route('company.approach'),
            route('company.team'),
            route('company.partners'),
            route('contact'),
            ...collect(array_keys(SiteContent::solutions()))->map(fn (string $slug): string => route('solutions.show', $slug))->all(),
            ...collect(array_keys(SiteContent::services()))->map(fn (string $slug): string => route('services.show', $slug))->all(),
            ...collect(SiteContent::services()['erp-odoo']['odoo']['categories'] ?? [])->map(fn (array $category): string => route('services.odoo-category', $category['slug']))->all(),
            ...collect(array_keys(SiteContent::industries()))->map(fn (string $slug): string => route('industries.show', $slug))->all(),
            ...collect(array_keys(SiteContent::insights()))->map(fn (string $slug): string => route('insights.show', $slug))->all(),
        ];

        return response()->view('sitemap', ['urls' => array_values(array_unique($urls))], 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
