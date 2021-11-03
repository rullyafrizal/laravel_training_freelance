<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface UserRepositoryInterface {
    public function all(): Collection;
    public function find($id);
    public function create(array $payload = []);
    public function update($id, array $payload = []);
    public function delete($id);
}
