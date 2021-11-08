<?php

namespace App\Repositories\Implements;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(private Comment $model)
    {}

    public function all($post): Collection
    {
        return $this->model
            ->newQuery()
            ->where('post_id', $post)
            ->with(['post', 'user'])
            ->get();
    }

    public function find($post, $comment): Model|Collection|Builder|array|null
    {
        $comment = $this->model
            ->newQuery()
            ->where('post_id', $post)
            ->with(['user', 'post'])
            ->find($comment);

        return !$comment ?
            throw new ModelNotFoundException() :
            $comment;
    }

    public function create($post, array $payload = []): Model|Builder
    {
        return $this->model->create($payload);
    }

    public function update($post, $comment, array $payload = []): bool | int
    {
        return $this->find($post, $comment)->update($payload);
    }

    public function delete($post, $comment)
    {
        return $this->find($post, $comment)->delete();
    }
}
