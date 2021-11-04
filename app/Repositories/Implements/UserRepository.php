<?php

namespace App\Repositories\Implements;

use App\Enums\HttpStatus;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class UserRepository extends BaseRepository implements  UserRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find($id): Model|Collection|Builder|array|null
    {
        $user = $this->model->find($id);

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
