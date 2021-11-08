<?php

namespace App\Repositories\Implements;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements  UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->newQuery()->with(['posts', 'comments'])->get();
    }

    public function find($id): Model|Collection|Builder|array|null
    {
        $user = $this->model->newQuery()->with(['posts', 'comments'])->find($id);

        return !$user ?
            throw new ModelNotFoundException() :
            $user;
    }

    public function create(array $payload = []): Model|Builder
    {
        return $this->model->create($payload);
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
