<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\GrowthRecord;
use App\Models\Student;
use App\Models\Work;
use Carbon\CarbonPeriod;

class StatisticsController extends Controller
{
    public function index()
    {
        $attendanceRate = $this->attendanceRate();
        $postTrend = $this->postTrend();
        $topStudents = Student::withCount(['works', 'growthRecords'])->orderByDesc('works_count')->take(5)->get();

        return view('admin.statistics.index', compact('attendanceRate', 'postTrend', 'topStudents'));
    }

    private function attendanceRate(): array
    {
        $period = CarbonPeriod::create(now()->subMonth()->startOfDay(), '1 week', now());
        $data = [];

        foreach ($period as $date) {
            $weekAttendances = Attendance::whereBetween('check_in', [$date, (clone $date)->addWeek()])->count();
            $data[] = [
                'week' => $date->format('Y-m-d'),
                'attendance' => $weekAttendances,
            ];
        }

        return $data;
    }

    private function postTrend(): array
    {
        $period = CarbonPeriod::create(now()->subMonth()->startOfWeek(), '1 week', now());
        $data = [];

        foreach ($period as $date) {
            $works = Work::whereBetween('created_at', [$date, (clone $date)->addWeek()])->count();
            $records = GrowthRecord::whereBetween('created_at', [$date, (clone $date)->addWeek()])->count();
            $data[] = [
                'week' => $date->format('Y-m-d'),
                'works' => $works,
                'growth_records' => $records,
            ];
        }

        return $data;
    }
}
