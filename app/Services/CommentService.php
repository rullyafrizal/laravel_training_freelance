<?php

namespace App\Services;

use App\Http\Resources\Comment\CommentCollection;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentService
{
    public function __construct(private CommentRepositoryInterface $commentRepository)
    {}

    public function createComment($post, array $payload = []) {
        $payload = array_merge(['post_id' => $post], $payload);

        return $this->commentRepository->create($post, $payload);
    }

    public function getComments($post) {
        return new CommentCollection($this->commentRepository->all($post));
    }

    public function getComment($post, $comment) {
        return $this->commentRepository->find($post, $comment);
    }

    public function updateComment($post, $comment, array $payload = []) {
        return $this->commentRepository->update($post, $comment, $payload);
    }

    public function deleteComment($post, $comment) {
        return $this->commentRepository->delete($post, $comment);
    }
}
