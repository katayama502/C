<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student()->with(['works', 'growthRecords', 'badges'])->firstOrFail();
        $badgeCount = $student->badges->count();
        $nextBadgeThreshold = $this->nextBadgeThreshold($student->works->count() + $student->growthRecords->count());

        return view('student.dashboard', compact('student', 'badgeCount', 'nextBadgeThreshold'));
    }

    private function nextBadgeThreshold(int $posts): int
    {
        $thresholds = [1, 5, 10, 20, 50];
        foreach ($thresholds as $threshold) {
            if ($posts < $threshold) {
                return $threshold;
            }
        }

        return end($thresholds);
    }
}
