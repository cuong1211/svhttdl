<?php

namespace Database\Factories\Staff;
use App\Models\Staff\Department;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Department::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->text,
        ];
    }
}
