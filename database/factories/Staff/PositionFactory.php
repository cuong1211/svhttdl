<?php

namespace Database\Factories\Staff;

use App\Models\Staff\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Position::class;
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'description' => $this->faker->text,
        ];
    }
}
