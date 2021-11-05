<?php

namespace App\Services;

use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentService
{
    public function __construct(private CommentRepositoryInterface $commentRepository)
    {}

    public function createComment($post, array $payload = []) {
        $payload = array_merge(['post_id' => $post], $payload);

        return $this->commentRepository->create($payload);
    }

    public function getComments() {
        return $this->commentRepository->all();
    }

    public function getComment($id) {
        return $this->commentRepository->find($id);
    }

    public function updateComment($id, array $payload = []) {
        return $this->commentRepository->update($id, $payload);
    }

    public function deleteComment($id) {
        return $this->commentRepository->delete($id);
    }
}
