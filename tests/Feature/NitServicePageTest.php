<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NitServicePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_cards_link_to_each_nit_service_detail_page(): void
    {
        app()->setLocale('en');

        foreach (['it-consulting', 'web-development', 'erp-odoo', 'cloud-management', 'cybersecurity'] as $slug) {
            Service::factory()->create(['slug' => $slug]);
        }

        $response = $this->get(route('home'));

        $response->assertOk();

        foreach ([
            'it-portfolio-management',
            'enterprise-architecture',
            'it-governance-audit',
            'it-training',
            'software-hardware-development',
            'multimedia',
        ] as $slug) {
            $response->assertSee(route('services.show', $slug), false);
        }

        $response->assertSee('View more');
    }

    public function test_each_nit_service_detail_route_renders_its_service_title(): void
    {
        app()->setLocale('en');

        $services = [
            'it-portfolio-management' => 'IT Portfolio Management',
            'enterprise-architecture' => 'Enterprise Architecture',
            'it-governance-audit' => 'IT Governance & Audit',
            'it-training' => 'IT Training',
            'software-hardware-development' => 'Software & Hardware Development',
            'multimedia' => 'Multimedia',
        ];

        foreach ($services as $slug => $title) {
            $response = $this->get(route('services.show', $slug));

            $response->assertOk();
            $response->assertSee($title);
        }
    }
}
