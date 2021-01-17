<?php

namespace App\Contracts\Repositories;

use App\Models\Employee;

interface EmployeeRepositoryContract extends AbstractRepositoryContract
{
    public function create(array $data): ?Employee;

    public function update(string $id, array $data): bool;

    public function delete(string $id): bool;
}
