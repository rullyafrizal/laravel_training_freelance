<?php

namespace App\Repositories\Implements;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find($id): Model|Collection|Builder|array|null
    {
        $comment = $this->model->find($id);

        return !$comment ?
            throw new ModelNotFoundException() :
            $comment;
    }

    public function create(array $payload = []): Model|Builder
    {
        return $this->model->create($payload);
    }

    public function update($id, array $payload = []): bool | int
    {
        return $this->find($id)->update($payload);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
