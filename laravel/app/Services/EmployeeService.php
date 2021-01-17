<?php

namespace App\Services;

use App\Contracts\Repositories\EmployeeRepositoryContract;
use App\Contracts\Services\EmployeeServiceContract;
use Illuminate\Database\Eloquent\Model;

class EmployeeService implements EmployeeServiceContract
{
    private EmployeeRepositoryContract $employeeRepository;

    public function __construct(EmployeeRepositoryContract $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function create(array $fields): Model
    {
        try {
            $employee = $this->employeeRepository->create($fields);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 409);
        }

        return $employee;
    }

    public function update(string $id, array $data): bool
    {
        return $this->employeeRepository->update($id, $data);
    }

    public function delete(string $id): bool
    {
        return $this->employeeRepository->delete($id);
    }
}
