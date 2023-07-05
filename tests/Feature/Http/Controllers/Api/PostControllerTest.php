<?php

namespace Http\Controllers\Api;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testPostCreatedSuccessfully(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/api/v1/posts', [
                'title'   => 'Lorem',
                'content' => 'Ipsum',
                'user_id' => $user->id,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertStatus(201);
    }

    public function testPostUpdatedSuccessfully(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'title'   => 'Title',
            'content' => 'Content',
            'user_id' => $user->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->patch('api/v1/posts/' . $post->id, [
                'title'   => 'Lorem',
                'content' => 'Ipsum',
            ]);

        $post->refresh();

        $this->assertSame('Lorem', $post->title);
        $this->assertSame('Ipsum', $post->content);
        $response
            ->assertSessionHasNoErrors()
            ->assertOk();
    }

    public function testPostDeletedSuccessfully(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'title'   => 'Title',
            'content' => 'Content',
            'user_id' => $user->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->delete('api/v1/posts/' . $post->id);

        $response
            ->assertSessionHasNoErrors()
            ->assertOk();
    }

    public function testPostsAreListedCorrectly(): void
    {
        $user = User::factory()->create();
        Post::factory()->create([
            'title'   => 'Title 1',
            'content' => 'Content 1',
            'user_id' => $user->id,
        ]);
        Post::factory()->create([
            'title'   => 'Title 2',
            'content' => 'Content 2',
            'user_id' => $user->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('api/v1/posts');

        $response
            ->assertSessionHasNoErrors()
            ->assertOk()
            ->assertJson([
                'data' => [
                    'data' => [
                        [
                            'title'   => 'Title 1',
                            'content' => 'Content 1',
                        ],
                        [
                            'title'   => 'Title 2',
                            'content' => 'Content 2',
                        ],
                    ],
                ],
            ]);
        ;
    }
}
