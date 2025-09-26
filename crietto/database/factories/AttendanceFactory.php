<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
 */
class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition(): array
    {
        $checkIn = $this->faker->dateTimeBetween('-1 month', 'now');
        $checkOut = (clone $checkIn)->modify('+'.rand(1, 3).' hours');

        return [
            'student_id' => Student::factory(),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'notes' => $this->faker->sentence(),
        ];
    }
}
