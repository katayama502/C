<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\GrowthRecord;
use App\Models\Student;
use App\Models\Work;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $studentCount = Student::count();
        $workCount = Work::count();
        $recordCount = GrowthRecord::count();
        $attendanceToday = Attendance::whereDate('check_in', today())->count();

        return view('admin.dashboard', compact('studentCount', 'workCount', 'recordCount', 'attendanceToday'));
    }
}
