<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface CommentRepositoryInterface
{
    public function all($post): Collection;
    public function find($post, $comment): Model|Collection|Builder|array|null;
    public function create($post, array $payload = []): Model|Builder;
    public function update($post, $comment, array $payload = []): bool|int;
    public function delete($post, $comment);
}
