<?php

namespace Database\Factories\Staff;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Staff\Staff;
use App\Models\Staff\Position;
use App\Models\Staff\Department;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Staff::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'content' => $this->faker->text,
            'department_id' => Department::factory(),
            'position_id' => Position::factory(),
        ];
    }
}
