<?php

namespace Tests\Feature\Admin;

use App\Models\Client;
use App\Models\Insight;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DashboardDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_uses_live_business_and_content_data(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('media/dashboard.png', 'image');

        $user = User::factory()->create();
        $client = Client::factory()->create();
        Project::factory()->create(['client_id' => $client->id, 'status' => 'in_progress']);
        Service::factory()->create(['is_active' => true]);
        TeamMember::factory()->create(['is_active' => true]);
        Insight::factory()->create(['is_published' => true]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertViewHas('stats', function (array $stats): bool {
                return $stats[0]['value'] === '1'
                    && $stats[1]['value'] === '1'
                    && $stats[2]['value'] === '1'
                    && $stats[3]['value'] === '1'
                    && $stats[4]['value'] === '1';
            })
            ->assertViewHas('contentStats', ['team' => 1, 'media' => 1])
            ->assertViewHas('latestInsights', fn ($insights): bool => $insights->count() === 1);
    }
}
