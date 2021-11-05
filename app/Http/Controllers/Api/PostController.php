<?php

namespace App\Http\Controllers\Api;

use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {}

    public function index()
    {
        return sendResponse(
            HttpStatus::OK,
            'Success fetching posts',
            $this->postService->getPosts()
        );
    }

    public function show($id)
    {
        return sendResponse(
            HttpStatus::OK,
            "Success fetching user : [$id]",
            $this->postService->getPost($id)
        );
    }

    public function store(CreatePostRequest $request)
    {
        return sendResponse(
            HttpStatus::CREATED,
            'Success creating post',
            $this->postService->createPost($request->validated())
        );
    }

    public function update($id, UpdatePostRequest $request)
    {
        $this->postService->updatePost($id, $request->validated());

        return sendResponse(
            HttpStatus::OK,
            "Success updating post : [$id]",
        );
    }

    public function destroy($id)
    {
        $this->postService->deletePost($id);

        return sendResponse(
            HttpStatus::OK,
            "Success deleting post : [$id]"
        );
    }
}
