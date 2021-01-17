<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Contracts\Repositories\EmployeeRepositoryContract;

class EmployeeRepository extends AbstractRepository implements EmployeeRepositoryContract
{

    public function create(array $data): ?Employee
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): bool
    {
        $Employee = $this->getById($id);

        return $Employee->fill($data)->save();
    }

    public function delete(string $id): bool
    {
        return $this->getById($id)->delete();
    }
}
