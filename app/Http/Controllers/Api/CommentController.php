<?php

namespace App\Http\Controllers\Api;

use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(private CommentService $commentService)
    {}

    public function index($post) {
        return sendResponse(
            HttpStatus::OK,
            'Success fetching comments',
            $this->commentService->getComments($post)
        );
    }

    public function show($post, $comment) {
        return sendResponse(
            HttpStatus::OK,
            'Success fetching comment',
            $this->commentService->getComment($post, $comment)
        );
    }

    public function store($post, CreateCommentRequest $request) {
        return sendResponse(
            HttpStatus::CREATED,
            'Success creating comment',
            $this->commentService->createComment($post, $request->validated())
        );
    }

    public function update($post, $comment, UpdateCommentRequest $request) {
        $this->commentService->updateComment($post, $comment, $request->validated());
        return sendResponse(
            HttpStatus::OK,
            'Success updating comment'
        );
    }

    public function destroy($post, $comment) {
        $this->commentService->deleteComment($post, $comment);

        return sendResponse(
            HttpStatus::OK,
            'Success deleting comment'
        );
    }
}
