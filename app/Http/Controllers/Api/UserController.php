<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Enums\HttpStatus;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return sendResponse(
            HttpStatus::OK,
            'Success fetching users',
            $this->userService->getUsers()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserRequest $request)
    {
        return sendResponse(
            HttpStatus::CREATED,
            'Success creating user',
            $this->userService->createUser($request->validated())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return sendResponse(
            HttpStatus::OK,
            "Success fetching user with id: [$id]",
            $this->userService->getUser($id),
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->userService->updateUser($id, $request->validated());

        return sendResponse(
            HttpStatus::OK,
            'Success updating user data',
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return sendResponse(
            HttpStatus::OK,
            'Success deleting user data'
        );
    }

    public function getUserComments()
    {
        return sendResponse(
            HttpStatus::OK,
            'Success fetching user article comments',
            $this->userService->getUserComments()
        );
    }
}
