<?php

namespace App\Repositories\Implements;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

class UserRepository extends BaseRepository implements  UserRepositoryInterface {

    #[Pure] public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $payload = [])
    {
        return $this->model->create($payload);
    }

    public function update($id, array $payload = [])
    {
        return $this->find($id)->update($payload);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

}
