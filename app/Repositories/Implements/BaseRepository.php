<?php

namespace App\Repositories\Implements;

use App\Repositories\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {}

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find($id): Model|Collection|Builder|array|null
    {
        return $this->model->newQuery()->find($id);
    }

    public function create(array $payload = []): Model|Builder
    {
        return $this->model->newQuery()->create($payload);
    }

    public function update($id, array $payload = []): bool|int
    {
        return $this->find($id)->update($payload);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

}
