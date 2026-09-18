<?php

namespace Tests\Feature\Admin;

use App\Models\Client;
use App\Models\ConsultationRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_reports(): void
    {
        $this->get(route('admin.reports.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_view_live_reports(): void
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();
        Project::factory()->create(['client_id' => $client->id, 'status' => 'in_progress']);
        ConsultationRequest::factory()->create(['status' => 'new']);

        $this->actingAs($user)
            ->get(route('admin.reports.index'))
            ->assertOk()
            ->assertViewHas('summary', fn (array $summary): bool => $summary[0]['value'] === 1 && $summary[5]['value'] === 1)
            ->assertViewHas('projectStatuses', fn (array $statuses): bool => $statuses[0]['label'] === 'In Progress');
    }

    public function test_authenticated_admin_can_export_projects_as_csv(): void
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['company' => 'Nusa Digital']);
        Project::factory()->create(['client_id' => $client->id, 'name' => 'Website Relaunch']);

        $response = $this->actingAs($user)
            ->get(route('admin.reports.export'))
            ->assertOk()
            ->assertHeader('content-type', 'text/csv; charset=UTF-8');

        $this->assertStringContainsString('Website Relaunch', $response->streamedContent());
    }
}
