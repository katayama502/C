<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Badge;
use App\Models\GrowthRecord;
use App\Models\ParentProfile;
use App\Models\Student;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->state(['role' => User::ROLE_ADMIN, 'email' => 'admin@crietto.local'])->create();

        Student::factory(5)
            ->has(GrowthRecord::factory()->count(5))
            ->has(Work::factory()->count(3))
            ->has(Attendance::factory()->count(10))
            ->create()
            ->each(function (Student $student) {
                $thresholds = [1, 5, 10, 20];
                foreach ($thresholds as $threshold) {
                    $student->badges()->create([
                        'name' => Arr::random(['チャレンジャー', 'エキスパート', 'クリエーター', 'マスター']),
                        'description' => '投稿数が'.$threshold.'件を達成しました。',
                        'threshold' => $threshold,
                    ]);
                }
            });

        ParentProfile::factory(3)->create()->each(function (ParentProfile $parent) {
            $students = Student::inRandomOrder()->take(2)->pluck('id');
            $parent->students()->sync($students);
        });
    }
}
