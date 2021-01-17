<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_an_employee() {

        // make an instance of the Employee Factory
        $employee = Employee::factory()->make([
            'active' => true
        ]);

        // post the data to the employees store method
        $response = $this->post(route('employees.store'), [
            'name' => $employee->name,
            'pay_rate' => $employee->pay_rate,
            'job_title' => $employee->job_title,
            'active' => $employee->active
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('employees', [
            'name' => $employee->name,
            'pay_rate' => $employee->pay_rate,
            'job_title' => $employee->job_title,
            'active' => $employee->active
        ]);

    }

    public function test_can_get_list_of_all_employees()
    {
        // CreateEmployee 25 Employees in the database
        Employee::factory()->count(25)->create();

        // Get all Employees (Paginated)
        $response = $this->get(route('employees.index'));
        $response->assertSuccessful();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'job_title',
                    'pay_rate',
                    'active',
                    'deleted_at',
                    'created_at',
                    'updated_at',
                ]
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
            'meta' => [
                "current_page",
                "from",
                "path",
                "per_page",
                "to",
                "success",
                "message",
            ]
        ]);
    }

    public function test_can_get_a_single_employee()
    {
        $employee = Employee::factory()->create();
        $response = $this->get(route('employees.show', $employee->id));
        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                'id' => $employee->id,
                'name' => $employee->name,
                'job_title' => $employee->job_title,
                'pay_rate' => $employee->pay_rate,
                'active' => $employee->active
            ],
            'meta' => [
                'success' => true
            ]
        ]);
    }

    public function test_can_update_an_employee()
    {
        $employee = Employee::factory()->create([
            'active' => true
        ]);

        $response = $this->patch(route('employees.update', $employee->id), [
            'name' => $name = $this->faker->name,
            'job_title' => $job_title = $this->faker->jobTitle,
            'pay_rate' => $pay_rate = $this->faker->randomFloat(2, 10, 20),
            'active' => false
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'name' => $name,
            'job_title' => $job_title,
            'pay_rate' => $pay_rate,
            'active' => false
        ]);
    }

    public function test_can_delete_an_employee()
    {
        $employee = Employee::factory()->create([
            'active' => true
        ]);
        $response = $this->delete(route('employees.destroy', $employee->id));
        $response->assertSuccessful();
        $this->assertSoftDeleted('employees', [
            'id' => $employee->id,
            'active' => false
        ]);
    }

}
