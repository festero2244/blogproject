<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Testing\File;
use Tests\TestCase;

class BlogTest extends TestCase
{
    public function test_it_renders_the_blogs_index_page()
    {
        $response = $this->get('/blog');

        $response->assertStatus(200);
    }

    public function test_it_allows_guests_to_view_blogs_index_page()
    {
        $this->assertGuest();

        $this->get('/blog')
            ->assertStatus(200);
    }

    public function test_it_has_posts_on_blogs_index_page()
    {
        $posts = Post::factory()->count(5)->create();

        $this->get('/blog')
            ->assertViewHas('posts', $posts);
    }

    public function test_it_renders_posts_on_blogs_index_page()
    {
        $post = Post::factory()->create();

        $this->get('/blog')
            ->assertSee([
                $post->user->name,
                $post->title,
                $post->description,
                'Keep Reading',
                'Created on ' . $post->created_at->format('jS M Y'),
            ]);
    }

    public function test_it_renders_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->get('/blog/' . $post->slug);

        $response
            ->assertStatus(200)
            ->assertViewHas('post', $post)
            ->assertSee([
                $post->user->name,
                $post->title,
                $post->description,
                'Created on ' . $post->created_at->format('jS M Y'),
            ]);
    }

    public function test_it_allows_guests_to_view_a_post()
    {
        $post = Post::factory()->create();

        $this->assertGuest();

        $response = $this->get('/blog/' . $post->slug);

        $response->assertStatus(200);
    }

    public function test_guests_cant_view_create_post_page()
    {
        $this->assertGuest();

        $response = $this->get('/blog/create');

        $response->assertRedirect('login');
    }

    public function test_users_can_view_create_post_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/blog/create');

        $response
            ->assertStatus(200)
            ->assertSeeInOrder([
                'form',
                'input',
                'title',
                'textarea',
                'description',
                'input',
                'image',
                'Submit Post',
                'form',
            ]);
    }

    /**
     * @dataProvider providesInvalidBlogPost
     */
    public function test_store_validates_a_post($postDetails)
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/blog', $postDetails);

        $response
            ->assertRedirect()
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('posts', [
            'title' => 'This is a sample title',
            'description' => 'This is a very long post that should fit 1000 words',
        ]);
    }

    /**
     * @dataProvider providesValidBlogPost
     */
    public function test_it_stores_a_post($postDetails)
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/blog', $postDetails);

        $response
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('posts', [
            'title' => 'This is a sample title',
            'description' => 'This is a very long post that should fit 1000 words',
        ]);
    }

    /**
     * @dataProvider providesValidBlogPost
     */
    public function test_it_uploads_post_image($postDetails)
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/blog', $postDetails);

        $response->assertSessionHasNoErrors();
        $post = Post::query()->first();
        unset($postDetails['image']);

        $this->assertEquals($postDetails, ['title' => $post->title, 'description' => $post->description]);

        $this->assertFileExists(public_path('public/Image/' . $post->image_path));
    }

    /**
     * @dataProvider providesValidBlogPost
     */
    public function test_it_creates_a_slug_for_a_post($post)
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/blog', $post);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('posts', [
            'title' => 'This is a sample title',
            'description' => 'This is a very long post that should fit 1000 words',
            "slug" => "this-is-a-sample-title",
        ]);
    }

    public function test_guests_cant_edit_create_post_page()
    {
        $post = Post::factory()->create();

        $this->assertGuest();

        $response = $this->get('/blog/' . $post->slug . '/edit');

        $response->assertRedirect('login');
    }

    public function test_users_can_edit_their_own_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $response = $this->actingAs($user)->get('/blog/' . $post->slug . '/edit');

        $response
            ->assertStatus(200)
            ->assertSeeInOrder([
                $post->slug,
                'PUT',
                $post->title,
                $post->description,
            ]);
    }

    public function test_users_cannot_edit_posts_they_dont_own()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->assertNotEquals($user->id, $post->user_id);

        $response = $this->actingAs($user)->get('/blog/' . $post->slug . '/edit');

        $response
            ->assertStatus(404)
            ->assertDontSee([
                $post->slug,
                'PUT',
                $post->description,
            ]);
    }

    /**
     * @dataProvider providesInvalidBlogPost
     */
    public function test_it_validates_post_update($postDetails)
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $response = $this
            ->actingAs($user)
            ->put('/blog/' . $post->slug, $postDetails);

        $response
            ->assertRedirect()
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
            'title' => 'This is a sample title',
            'description' => 'This is a very long post that should fit 1000 words',
            "slug" => "this-is-a-sample-title",
        ]);
    }

    /**
     * @dataProvider providesValidBlogPost
     */
    public function test_users_can_update_their_own_post($postDetails)
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $response = $this
            ->actingAs($user)
            ->put('/blog/' . $post->slug, $postDetails);

        $response
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'This is a sample title',
            'description' => 'This is a very long post that should fit 1000 words',
            "slug" => "this-is-a-sample-title",
        ]);
    }

    /**
     * @dataProvider providesValidBlogPost
     */
    public function test_users_cannot_update_posts_they_dont_own($postDetails)
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->assertNotEquals($user->id, $post->user_id);

        $response = $this
            ->actingAs($user)
            ->put('/blog/' . $post->slug, $postDetails);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
            'title' => 'This is a sample title',
            'description' => 'This is a very long post that should fit 1000 words',
            "slug" => "this-is-a-sample-title",
        ]);
    }

    public function test_users_can_delete_their_own_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $response = $this
            ->actingAs($user)
            ->delete('/blog/' . $post->slug);

        $response
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertFalse($post->exists());
    }

    public function test_users_cannot_delete_post_they_dont_own()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->assertNotEquals($user->id, $post->user_id);

        $response = $this
            ->actingAs($user)
            ->delete('/blog/' . $post->slug);

        $response->assertRedirect();

        $this->assertTrue($post->exists());
    }

    public function providesValidBlogPost()
    {
        return [
            [
                [
                    'title' => 'This is a sample title',
                    'description' => 'This is a very long post that should fit 1000 words',
                    'image' => File::image('blog-image.png'),
                ],
            ],
        ];
    }

    public function providesInvalidBlogPost()
    {
        return [
            [
                [
                    'description' => 'This is a very long post that should fit 1000 words',
                    'image' => File::image('blog-image.png'),
                ],
                [
                    'title' => 'This is a sample title',
                    'image' => File::image('blog-image.png'),
                ],
                [
                    'title' => 'This is a sample title',
                    'description' => 'This is a very long post that should fit 1000 words',
                    'image' => File::create('malicious-file.exe'),
                ],
                [
                    'title' => 'This is a sample title',
                    'description' => 'This is a very long post that should fit 1000 words',
                    'image' => File::create('large-image.png', 5060),
                ],
            ],
        ];
    }
}
