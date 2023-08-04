<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->user = $user;
        $this->actingAs($user);
    }

    /** @test */
    public function test_it_returns_paginated_list_of_posts_with_user_information()
    {
        Post::factory()->count(5)->create();

        $response = $this->getJson('/posts');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'excerpt',
                        'content',
                        'user' => [
                            'id',
                            'name',
                        ],
                        'created_at',
                    ],
                ],
                'links',
                'meta',
            ]);
    }

    /** @test */
    public function it_creates_a_new_post_for_authenticated_user()
    {
        $response = $this->postJson('/posts', [
            'title' => $this->faker->sentence,
            'excerpt' => $this->faker->paragraph,
            'content' => $this->faker->paragraph(10),
        ]);

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'id',
                'title',
                'content',
                'created_at',
            ]);
    }

    /** @test */
    public function it_returns_post_details_by_id()
    {
        $post = Post::factory()->create();
        $response = $this->getJson('/posts/' . $post->id);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'title',
                'content',
                'created_at',
            ]);
    }

    /** @test */
    public function it_updates_post_details_for_authorized_user()
    {
        $post = Post::factory()->create(['user_id' => $this->user->id]);

        $response = $this->putJson('/posts/' . $post->id, [
            'title' => $this->faker->sentence,
            'excerpt' => $this->faker->paragraph,
            'content' => $this->faker->paragraph(10),
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'title',
                'content',
                'created_at',
            ]);
    }

    /** @test */
    public function it_deletes_post_for_authorized_user()
    {
        $post = Post::factory()->create(['user_id' => $this->user->id]);

        $response = $this->deleteJson('/posts/' . $post->id);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertNull(Post::find($post->id));
    }
}
