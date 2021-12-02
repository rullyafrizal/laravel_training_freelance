<?php

namespace Tests\Unit;

use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Repositories\Implements\PostRepository;
use App\Services\PostService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class PostServiceTest extends TestCase
{
    private $postService;

    public function __construct()
    {
        parent::__construct();
        $this->postService = new PostService(new PostRepository(new Post()));
    }

    public function test_fetch_posts_normal_response()
    {
        $response = $this->postService->getPosts();

        $this->assertInstanceOf(PostCollection::class, $response);
    }

    public function test_fetch_post_normal_response()
    {
        $response = $this->postService->getPost(1);

        $this->assertInstanceOf(PostResource::class, $response);
    }

    public function test_fetch_post_not_found()
    {
        $this->withExceptionHandling()
            ->expectException(ModelNotFoundException::class);

        $this->postService->getPost(1000);
    }

    public function test_create_post()
    {
        $payload = [
            'title' => 'Testing title 1',
            'content' => 'Testing content 1',
            'user_id' => 11
        ];

        $response = $this->postService->createPost($payload);

        $this->assertInstanceOf(Post::class, $response);
    }

    public function test_update_post()
    {
        $payload = [
            'title' => 'Testing title 1 Edited',
            'content' => 'Testing content 1',
        ];

        $response = $this->postService->updatePost(14, $payload);

        $this->assertTrue($response);
    }

    public function test_delete_post()
    {
        $post = $this->postService->createPost([
            'title' => 'Testing delted post',
            'content' => 'Testing deleted post',
            'user_id' => 11
        ]);

        $response = $this->postService->deletePost($post->id);

        $this->assertTrue($response);
    }
}
