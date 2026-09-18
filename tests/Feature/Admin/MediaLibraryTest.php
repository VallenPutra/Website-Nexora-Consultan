<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaLibraryTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_media_library(): void
    {
        $this->get(route('admin.media.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_upload_a_media_file(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.media.store'), [
            'file' => UploadedFile::fake()->image('brand-mark.png'),
        ]);

        $response->assertRedirect(route('admin.media.index'));
        $this->assertCount(1, Storage::disk('public')->files('media'));
    }

    public function test_media_library_rejects_unsupported_files(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('admin.media.index'))
            ->post(route('admin.media.store'), [
                'file' => UploadedFile::fake()->create('malware.exe', 10, 'application/octet-stream'),
            ])
            ->assertRedirect(route('admin.media.index'))
            ->assertSessionHasErrors('file');
    }

    public function test_authenticated_admin_can_delete_a_media_file(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('media/old-file.pdf', 'demo');
        $user = User::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.media.destroy', ['path' => 'media/old-file.pdf']))
            ->assertRedirect(route('admin.media.index'));

        Storage::disk('public')->assertMissing('media/old-file.pdf');
    }
}
