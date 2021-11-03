<?php

namespace App\Repositories\Interfaces;

interface EloquentRepositoryInterface {
    public function all();
    public function find($id);
    public function create(array $payload = []);
    public function update($id, array $payload = []);
    public function delete($id);
}
