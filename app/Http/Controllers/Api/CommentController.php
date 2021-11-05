<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(private CommentService $commentService)
    {}

    public function index() {
        return $this->commentService->getComments();
    }

    public function show($id) {
        return $this->commentService->getComment($id);
    }

    public function store($post, CreateCommentRequest $request) {
        dd($post);
        return $this->commentService->createComment($post, $request->validated());
    }

    public function update($id, UpdateCommentRequest $request) {
        return $this->commentService->updateComment($id, $request->validated());
    }

    public function destroy($id) {
        return $this->commentService->deleteComment($id);
    }
}
