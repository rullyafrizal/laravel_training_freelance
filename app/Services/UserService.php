<?php

namespace App\Services;

use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {}

    public function getUsers(): UserCollection
    {
        return new UserCollection($this->userRepository->all());
    }

    public function getUser($id): UserResource
    {
        return new UserResource($this->userRepository->find($id));
    }

    public function createUser(array $payload = []): Model|Builder
    {
        return $this->userRepository->create($payload);
    }

    public function updateUser($id, array $payload = []): bool|int
    {
        return $this->userRepository->update($id, $payload);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
