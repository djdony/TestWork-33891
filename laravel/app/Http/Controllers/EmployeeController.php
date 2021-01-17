<?php

namespace App\Http\Controllers;

use App\Contracts\Services\EmployeeServiceContract;
use App\Http\Requests\Employee\CreateEmployee;
use App\Http\Requests\Employee\UpdateEmployee;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{
    private EmployeeServiceContract $EmployeeService;

    public function __construct(EmployeeServiceContract $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index(Request $request)
    {
        return EmployeeResource::collection(
            Employee::simplePaginate($request->input('paginate') ?? 15)
        );
    }

    public function store(CreateEmployee $request)
    {
        $employee = $this->employeeService->create($request->validated());

        return (new EmployeeResource($employee->toArray()))
            ->additional([
                'meta' => [
                    'success' => true,
                    'message' => "employees created"
                ]
            ]);
    }

    public function show(Employee $employee)
    {
        return (new EmployeeResource($employee))
            ->additional([
                'meta' => [
                    'success' => true,
                    'message' => "employees found"
                ]
            ]);
    }

    public function update(string $id, UpdateEmployee $request)
    {
        $employee = $this->employeeService->update($id, $request->validated());

        return $this->sendResponse($employee, 'employees updated');
    }

    public function destroy(string $id)
    {
        $employee = $this->employeeService->delete($id);

        return $this->sendResponse($employee, 'employees has been deleted');

    }
}
