<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceContract;
use App\Http\Requests\User\CreateUser;
use App\Http\Requests\User\UpdateUser;

class UserController extends BaseController
{
    private UserServiceContract $userService;

    public function __construct(UserServiceContract $userService) {
        $this->userService = $userService;
    }

    public function register(CreateUser $request)
    {
        $user = $this->userService->registerUser($request->validated());

        return new CreateUser($user->toArray());
    }

    public function update(string $id, UpdateUser $request)
    {
        $user = $this->userService->update($id, $request->all());

        return $user
            ? $this->sendResponse($user, 'Ok')
            : $this->sendError('Error');
    }
}
