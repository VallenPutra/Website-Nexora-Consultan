<?php

namespace Tests\Feature\Admin;

use App\Models\ConsultationRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsultationRequestManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_contact_form_stores_a_consultation_request(): void
    {
        $response = $this->post(route('contact.submit'), [
            'name' => 'Andi Pratama',
            'email' => 'andi@example.com',
            'company' => 'PT Maju Digital',
            'phone' => '+62 812 1234 5678',
            'service' => 'web-development',
            'budget' => '50-150m',
            'message' => 'We need a new website.',
        ]);

        $response->assertRedirect(route('contact'));
        $this->assertDatabaseHas('consultation_requests', ['email' => 'andi@example.com', 'status' => 'new']);
    }

    public function test_guests_are_redirected_from_consultation_requests(): void
    {
        $this->get(route('admin.consultation-requests.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_update_request_status(): void
    {
        $user = User::factory()->create();
        $requestItem = ConsultationRequest::factory()->create();

        $this->actingAs($user)
            ->put(route('admin.consultation-requests.update', $requestItem), [
                'status' => 'contacted',
                'admin_notes' => 'Called the client.',
            ])
            ->assertRedirect(route('admin.consultation-requests.show', $requestItem));

        $this->assertDatabaseHas('consultation_requests', ['id' => $requestItem->id, 'status' => 'contacted', 'admin_notes' => 'Called the client.']);
    }

    public function test_authenticated_admin_can_delete_a_request(): void
    {
        $user = User::factory()->create();
        $requestItem = ConsultationRequest::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.consultation-requests.destroy', $requestItem))
            ->assertRedirect(route('admin.consultation-requests.index'));

        $this->assertDatabaseMissing('consultation_requests', ['id' => $requestItem->id]);
    }

    public function test_visitor_can_start_a_consultation_chat_and_admin_can_reply(): void
    {
        $response = $this->postJson(route('consultation-chat.start'), [
            'name' => 'Maya Visitor',
            'email' => 'maya@example.com',
            'message' => 'I need a direct consultation.',
        ]);

        $response->assertOk()->assertJsonStructure(['token', 'messages']);
        $token = $response->json('token');
        $requestItem = ConsultationRequest::where('chat_token', $token)->firstOrFail();
        $this->assertDatabaseHas('consultation_messages', ['consultation_request_id' => $requestItem->id, 'sender_type' => 'visitor']);

        $this->actingAs(User::factory()->create())
            ->post(route('admin.consultation-requests.messages.store', $requestItem), ['body' => 'We can help you directly.'])
            ->assertRedirect(route('admin.consultation-requests.show', $requestItem));

        $this->getJson(route('consultation-chat.messages', $token))
            ->assertOk()
            ->assertJsonCount(2, 'messages');
        $this->assertDatabaseHas('consultation_messages', ['consultation_request_id' => $requestItem->id, 'sender_type' => 'admin']);
    }
}
