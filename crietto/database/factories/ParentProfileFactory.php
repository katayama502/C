<?php

namespace Database\Factories;

use App\Models\ParentProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ParentProfile>
 */
class ParentProfileFactory extends Factory
{
    protected $model = ParentProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => User::ROLE_PARENT]),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'notification_enabled' => true,
        ];
    }
}
