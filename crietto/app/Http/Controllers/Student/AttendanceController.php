<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Auth::user()->student->attendances()->latest()->paginate();
        return view('student.attendance.index', compact('attendances'));
    }
}
