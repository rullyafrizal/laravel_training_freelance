<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\ApiHttpResponseService;
use Illuminate\Http\Request;
use App\Enums\HttpStatus;

class UserController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository, private ApiHttpResponseService $apiHttp)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = $this->userRepository->all();

        return $this->apiHttp
            ->sendResponse(
                HttpStatus::OK,
                'Success fetching users',
                $users
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserRequest $request)
    {
        $user = $this->userRepository->create($request->validated());

        return $this->apiHttp
            ->sendResponse(
                HttpStatus::CREATED,
                'Success creating user',
                $user
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
        return $this->apiHttp
            ->sendResponse(
                HttpStatus::OK,
                "Success fetching user with id: [${id}]",
                $this->userRepository->find($id),
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->userRepository->update($id, $request->validated());

        return $this->apiHttp
            ->sendResponse(
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
        $this->userRepository->delete($id);

        return $this->apiHttp
            ->sendResponse(
                HttpStatus::OK,
                'Success deleting user data'
            );
    }
}
