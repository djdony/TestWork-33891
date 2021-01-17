<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Model;

interface EmployeeServiceContract
{
    public function create(array $fields): Model;

    public function update(string $id, array $data): bool;

    public function delete(string $id): bool;
}
