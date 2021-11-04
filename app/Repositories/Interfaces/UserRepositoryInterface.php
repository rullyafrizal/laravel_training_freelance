<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserRepositoryInterface {
    public function all(): Collection;
    public function find($id): Model|Collection|Builder|array|null;
    public function create(array $payload = []): Model|Builder;
    public function update($id, array $payload = []): bool|int;
    public function delete($id);
}
