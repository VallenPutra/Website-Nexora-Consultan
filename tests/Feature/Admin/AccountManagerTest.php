<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_standard_user_account(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('admin.account-manager.store'), [
            'name' => 'Managed User',
            'email' => 'managed@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $response->assertRedirect(route('admin.account-manager.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'managed@example.com',
            'role' => 'user',
        ]);
    }

    public function test_admin_can_remove_a_standard_user_account(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($admin)->delete(route('admin.account-manager.destroy', $user));

        $response->assertRedirect(route('admin.account-manager.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseHas('users', ['id' => $admin->id, 'role' => 'admin']);
    }

    public function test_user_account_manager_cannot_remove_an_admin_account(): void
    {
        $admin = User::factory()->admin()->create();
        $otherAdmin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->delete(route('admin.account-manager.destroy', $otherAdmin))
            ->assertNotFound();

        $this->assertDatabaseHas('users', ['id' => $otherAdmin->id, 'role' => 'admin']);
    }
}
