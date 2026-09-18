<?php

namespace Tests\Feature\Admin;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_project_management(): void
    {
        $this->get(route('admin.projects.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_create_a_project_for_a_client(): void
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.projects.store'), [
            'client_id' => $client->id,
            'name' => 'Website Relaunch',
            'service' => 'Web Development',
            'progress' => 25,
            'status' => 'in_progress',
            'deadline' => '2026-12-01',
            'description' => 'Refresh the public website.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', [
            'client_id' => $client->id,
            'name' => 'Website Relaunch',
            'status' => 'in_progress',
        ]);
    }

    public function test_project_requires_an_existing_client_and_valid_progress(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('admin.projects.create'))
            ->post(route('admin.projects.store'), [
                'client_id' => 999999,
                'name' => 'Invalid Project',
                'progress' => 120,
                'status' => 'planning',
            ])
            ->assertRedirect(route('admin.projects.create'))
            ->assertSessionHasErrors(['client_id', 'progress']);
    }

    public function test_authenticated_admin_can_delete_a_project(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.projects.destroy', $project))
            ->assertRedirect(route('admin.projects.index'));

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
