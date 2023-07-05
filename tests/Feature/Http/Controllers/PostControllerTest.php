<?php

namespace Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    public function testIndexPageIsDisplayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/posts');

        $response->assertOk();
    }

    public function testCreatePageIsDisplayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/posts/create');

        $response->assertOk();
    }

    public function testEditPageIsDisplayed(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'title'   => 'Lorem',
            'content' => 'Ipsum',
            'user_id' => $user->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/posts/' . $post->id . '/edit');

        $response->assertOk();
    }

    public function testShowPageIsDisplayed(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'title'   => 'Lorem',
            'content' => 'Ipsum',
            'user_id' => $user->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/posts/' . $post->id);

        $response->assertOk();
    }
}
