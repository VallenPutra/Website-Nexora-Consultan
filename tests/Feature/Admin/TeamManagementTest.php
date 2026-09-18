<?php

namespace Tests\Feature\Admin;

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_team_management(): void
    {
        $this->get(route('admin.team.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_create_a_team_member(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.team.store'), [
            'name' => 'Maya Kusuma',
            'role' => 'Lead UI/UX Designer',
            'expertise' => 'Product design, design systems',
            'bio' => 'Leads product design engagements.',
            'is_active' => '1',
            'sort_order' => 4,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('team_members', ['name' => 'Maya Kusuma', 'is_active' => true]);
    }

    public function test_team_member_requires_name_and_role(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('admin.team.create'))
            ->post(route('admin.team.store'), ['sort_order' => 0])
            ->assertRedirect(route('admin.team.create'))
            ->assertSessionHasErrors(['name', 'role']);
    }

    public function test_authenticated_admin_can_delete_a_team_member(): void
    {
        $user = User::factory()->create();
        $member = TeamMember::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.team.destroy', $member))
            ->assertRedirect(route('admin.team.index'));

        $this->assertDatabaseMissing('team_members', ['id' => $member->id]);
    }
}
