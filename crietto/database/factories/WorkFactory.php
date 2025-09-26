<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Work>
 */
class WorkFactory extends Factory
{
    protected $model = Work::class;

    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'file_path' => null,
            'link' => $this->faker->url(),
            'visibility' => 'parent',
        ];
    }
}
