<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_creates_a_user_without_accepting_a_role(): void
    {
        config(['nexora.registration_open' => true]);

        $response = $this->post(route('register'), [
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => 'admin',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('users', [
            'email' => 'user@example.com',
            'role' => 'user',
        ]);
        $this->assertAuthenticatedAs(User::where('email', 'user@example.com')->firstOrFail());
    }

    public function test_user_login_returns_to_the_public_website(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'password' => Hash::make('Password123!'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'Password123!',
        ]);

        $response->assertRedirect(route('home'));
    }

    public function test_admin_login_returns_to_the_admin_dashboard(): void
    {
        $admin = User::factory()->admin()->create([
            'password' => Hash::make('Password123!'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $admin->email,
            'password' => 'Password123!',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_user_cannot_access_admin_routes(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();

        $this->actingAs($user)
            ->get(route('admin.settings.index'))
            ->assertForbidden();
    }

    public function test_guest_is_redirected_to_login_for_admin_routes(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_admin_settings_only_lists_admin_accounts(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($admin)
            ->get(route('admin.settings.index'))
            ->assertOk()
            ->assertSee($admin->email)
            ->assertDontSee($user->email);
    }
}
