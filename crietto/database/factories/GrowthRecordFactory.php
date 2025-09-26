<?php

namespace Database\Factories;

use App\Models\GrowthRecord;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GrowthRecord>
 */
class GrowthRecordFactory extends Factory
{
    protected $model = GrowthRecord::class;

    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'content' => $this->faker->paragraph(),
            'mood' => $this->faker->randomElement(['楽しい', '普通', '難しい']),
            'learning_time' => $this->faker->numberBetween(30, 180),
        ];
    }
}
