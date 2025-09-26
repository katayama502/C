<?php

namespace Database\Factories;

use App\Models\Badge;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Badge>
 */
class BadgeFactory extends Factory
{
    protected $model = Badge::class;

    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'name' => $this->faker->randomElement(['Starter', 'Challenger', 'Creator', 'Master']),
            'description' => $this->faker->sentence(),
            'threshold' => $this->faker->numberBetween(1, 50),
        ];
    }
}
