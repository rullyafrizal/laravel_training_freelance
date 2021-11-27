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
}
