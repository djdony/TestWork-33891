<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

interface AbstractRepositoryContract
{
    public function getById($id): ?Model;

    public function create(array $fields): ?Model;

    public function update(string $id, array $fields): bool;

}
