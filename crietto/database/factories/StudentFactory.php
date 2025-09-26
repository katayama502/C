<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => User::ROLE_STUDENT]),
            'avatar' => null,
            'profile_icon' => $this->faker->randomElement(['robot', 'rocket', 'pencil', 'code']),
            'grade' => $this->faker->numberBetween(1, 9),
            'bio' => $this->faker->sentence(),
        ];
    }
}
