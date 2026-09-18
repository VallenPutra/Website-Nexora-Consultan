<?php

namespace Tests\Feature\Admin;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_service_management(): void
    {
        $this->get(route('admin.services.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_create_a_service(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.services.store'), [
            'slug' => 'data-migration',
            'title' => 'Data Migration',
            'short' => 'Move your business data safely.',
            'is_active' => '1',
            'sort_order' => 10,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('services', ['slug' => 'data-migration', 'is_active' => true]);
    }

    public function test_service_slug_must_be_unique_and_valid(): void
    {
        $user = User::factory()->create();
        Service::factory()->create(['slug' => 'existing-service']);

        $this->actingAs($user)
            ->from(route('admin.services.create'))
            ->post(route('admin.services.store'), [
                'slug' => 'existing-service',
                'title' => 'Duplicate Service',
                'sort_order' => 0,
            ])
            ->assertRedirect(route('admin.services.create'))
            ->assertSessionHasErrors('slug');
    }

    public function test_authenticated_admin_can_delete_a_service(): void
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.services.destroy', $service))
            ->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }
}
