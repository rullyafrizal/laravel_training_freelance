<?php

namespace App\Services;

use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostService
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {}

    public function getPosts()
    {
        return new PostCollection($this->postRepository->all());
    }

    public function getPost($id)
    {
        return new PostResource($this->postRepository->find($id));
    }

    public function createPost(array $payload = [])
    {
        return $this->postRepository->create($payload);
    }

    public function updatePost($id, array $payload = [])
    {
        return $this->postRepository->update($id, $payload);
    }

    public function deletePost($id)
    {
        return $this->postRepository->delete($id);
    }
}
