<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserAvatarControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_upload_avatar()
    {
        Storage::fake('s3');

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post('/user/avatar', [
                'regphoto' => UploadedFile::fake()->image('avatar.jpg'),
            ]);

        $response->assertStatus(200);

        Storage::disk('s3')->assertExists('avatars/' . $user->id . '/s3');
    }

    public function test_user_can_view_avatar()
    {
        Storage::fake('public');

        $user = factory(User::class)->create();

        $imagePath = 'avatars/' . $user->id . '/avatar.jpg';

        Storage::disk('public')->put($imagePath, 'dummy content');

        $response = $this->get('/user/avatar/' . $imagePath);

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/octet-stream');
    }

    public function test_user_cannot_view_nonexistent_avatar()
    {
        $response = $this->get('/user/avatar/nonexistent-image.jpg');

        $response->assertStatus(404);
    }
}