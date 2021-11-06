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

    public function index() {
        return sendResponse(
            HttpStatus::OK,
            'Success fetching comments',
            $this->commentService->getComments()
        );
    }

    public function show($id) {
        return sendResponse(
            HttpStatus::OK,
            'Success fetching comment',
            $this->commentService->getComment($id)
        );
    }

    public function store(CreateCommentRequest $request) {
        return sendResponse(
            HttpStatus::CREATED,
            'Success creating comment',
            $this->commentService->createComment($request->validated())
        );
    }

    public function update($id, UpdateCommentRequest $request) {
        $this->commentService->updateComment($id, $request->validated());
        return sendResponse(
            HttpStatus::OK,
            'Success updating comment'
        );
    }

    public function destroy($id) {
        $this->commentService->deleteComment($id);

        return sendResponse(
            HttpStatus::OK,
            'Success deleting comment'
        );
    }
}
