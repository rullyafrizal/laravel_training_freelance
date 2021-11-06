<?php

namespace App\Services;

use App\Http\Resources\Comment\CommentCollection;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentService
{
    public function __construct(private CommentRepositoryInterface $commentRepository)
    {}

    public function createComment(array $payload = []) {
        return $this->commentRepository->create($payload);
    }

    public function getComments() {
        return new CommentCollection($this->commentRepository->all());
    }

    public function getComment($comment) {
        return $this->commentRepository->find($comment);
    }

    public function updateComment($comment, array $payload = []) {
        return $this->commentRepository->update($comment, $payload);
    }

    public function deleteComment($comment) {
        return $this->commentRepository->delete($comment);
    }
}
