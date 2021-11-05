<?php

namespace App\Repositories\Implements;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find($id): Model|Collection|Builder|array|null
    {
        $post = $this->model->find($id);

        return !$post ?
            throw new ModelNotFoundException() :
            $post;
    }

    public function create(array $payload = []): Model|Builder
    {
        $payload = array_merge($payload, ['user_id' => 2]);

        return $this->model->create($payload);
    }

    public function update($id, array $payload = []): bool|int
    {
        $payload = array_merge($payload, ['user_id' => 2]);

        return $this->find($id)->update($payload);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

}
