<?php

namespace Tests\Feature\Admin;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_client_management(): void
    {
        $this->get(route('admin.clients.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_create_a_client(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.clients.store'), [
            'name' => 'Siti Rahma',
            'company' => 'Klinik Sehat',
            'email' => 'siti@example.com',
            'phone' => '+62 812 3456 7890',
            'industry' => 'Healthcare',
            'status' => 'active',
            'notes' => 'Primary contact',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('clients', [
            'name' => 'Siti Rahma',
            'company' => 'Klinik Sehat',
            'email' => 'siti@example.com',
        ]);
    }

    public function test_client_name_and_status_are_required(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('admin.clients.create'))
            ->post(route('admin.clients.store'), [])
            ->assertRedirect(route('admin.clients.create'))
            ->assertSessionHasErrors(['name', 'status']);
    }

    public function test_authenticated_admin_can_delete_a_client(): void
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.clients.destroy', $client))
            ->assertRedirect(route('admin.clients.index'));

        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    }
}
