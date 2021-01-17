<?php

namespace App\Repositories;

use App\Models\User;
use App\Contracts\Repositories\UserRepositoryContract;
use Illuminate\Support\Facades\Hash;

class UserRepository extends AbstractRepository implements UserRepositoryContract
{

    public function getByEmail(string $email): ?User
    {
        return $this->model
            ->where('email', $email)
            ->first();
    }

    public function create(array $data): ?User
    {
        $data['password'] = Hash::make($data['password']);

        return $this->model->create($data);
    }

    public function update(string $id, array $data): bool
    {
        $user = $this->getById($id);

        if ($data['password']){
            $data['password'] = Hash::make($data['password']);
        }

        return $user->fill($data)->save();
    }
}
