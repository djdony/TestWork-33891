<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\User;
use App\Contracts\Services\UserServiceContract;

class UserService implements UserServiceContract
{
    private UserRepositoryContract $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $fields): User
    {
        try {
            $user = $this->userRepository->create($fields);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 409);
        }

        return $user;
    }

    public function getUserById(string $id): User
    {
        return $this->userRepository->getUserById($id);
    }

    public function update(string $id, array $data): bool
    {
        return $this->userRepository->update($id, $data);
    }
}
