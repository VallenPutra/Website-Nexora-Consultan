<?php

namespace Tests\Feature\Admin;

use App\Models\Insight;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsightManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_insight_management(): void
    {
        $this->get(route('admin.insights.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_create_a_published_insight(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.insights.store'), [
            'slug' => 'new-insight',
            'category' => 'Business',
            'title' => 'A New Insight',
            'excerpt' => 'A useful summary.',
            'author' => 'NEXORA Editorial Team',
            'published_at' => '2026-09-18',
            'body' => 'Article body content.',
            'cover_image' => 'media/cover.png',
            'is_published' => '1',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('insights', ['slug' => 'new-insight', 'is_published' => true, 'cover_image' => 'media/cover.png']);
    }

    public function test_insight_requires_core_content_fields(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('admin.insights.create'))
            ->post(route('admin.insights.store'), [])
            ->assertRedirect(route('admin.insights.create'))
            ->assertSessionHasErrors(['slug', 'category', 'title', 'excerpt', 'author']);
    }

    public function test_authenticated_admin_can_delete_an_insight(): void
    {
        $user = User::factory()->create();
        $insight = Insight::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.insights.destroy', $insight))
            ->assertRedirect(route('admin.insights.index'));

        $this->assertDatabaseMissing('insights', ['id' => $insight->id]);
    }
}
