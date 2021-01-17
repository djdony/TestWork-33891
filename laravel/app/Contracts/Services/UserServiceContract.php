<?php

namespace App\Contracts\Services;

use App\Models\User;

interface UserServiceContract
{
    public function registerUser(array $fields): User;

    public function update(string $id, array $data): bool;
}
