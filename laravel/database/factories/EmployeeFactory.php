<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'job_title' => $this->faker->jobTitle,
            'pay_rate' => $this->faker->randomFloat(2, 10, 20),
            'active' => $this->faker->randomElement([true, false])
        ];
    }
}
