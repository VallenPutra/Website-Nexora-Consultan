<?php

namespace Tests\Feature\Admin;

use App\Models\Client;
use App\Models\Revenue;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RevenueManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_revenue_management(): void
    {
        $this->get(route('admin.revenue.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_create_a_revenue_entry_for_a_client(): void
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.revenue.store'), [
            'client_id' => $client->id,
            'description' => 'Website Development — Phase 1',
            'amount' => 15_000_000,
            'status' => 'pending',
            'invoice_date' => '2026-09-01',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('revenues', [
            'client_id' => $client->id,
            'description' => 'Website Development — Phase 1',
            'amount' => 15_000_000,
            'status' => 'pending',
        ]);
    }

    public function test_revenue_entry_requires_an_existing_client_and_valid_status(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('admin.revenue.create'))
            ->post(route('admin.revenue.store'), [
                'client_id' => 999999,
                'description' => 'Invalid Entry',
                'amount' => 1_000_000,
                'status' => 'not-a-real-status',
                'invoice_date' => '2026-09-01',
            ])
            ->assertRedirect(route('admin.revenue.create'))
            ->assertSessionHasErrors(['client_id', 'status']);
    }

    public function test_authenticated_admin_can_mark_a_revenue_entry_as_paid(): void
    {
        $user = User::factory()->create();
        $revenue = Revenue::factory()->create(['status' => 'pending', 'paid_at' => null]);

        $this->actingAs($user)
            ->patch(route('admin.revenue.mark-paid', $revenue))
            ->assertRedirect();

        $this->assertDatabaseHas('revenues', [
            'id' => $revenue->id,
            'status' => 'paid',
        ]);
        $this->assertNotNull($revenue->fresh()->paid_at);
    }

    public function test_authenticated_admin_can_delete_a_revenue_entry(): void
    {
        $user = User::factory()->create();
        $revenue = Revenue::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.revenue.destroy', $revenue))
            ->assertRedirect(route('admin.revenue.index'));

        $this->assertDatabaseMissing('revenues', ['id' => $revenue->id]);
    }
}
