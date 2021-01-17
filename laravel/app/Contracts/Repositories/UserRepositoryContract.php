<?php

namespace App\Contracts\Repositories;

use App\Models\User;

interface UserRepositoryContract extends AbstractRepositoryContract
{
    public function getByEmail(string $email): ?User;
}
