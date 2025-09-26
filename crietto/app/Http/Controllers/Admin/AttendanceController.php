<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('student.user')->latest()->paginate();
        $students = Student::with('user')->get();
        return view('admin.attendance.index', compact('attendances', 'students'));
    }

    public function checkIn(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
        ]);

        Student::findOrFail($validated['student_id'])->attendances()->create([
            'check_in' => now(),
        ]);

        return redirect()->route('admin.attendance.index')->with('status', __('登校を記録しました。'));
    }

    public function checkOut(Attendance $attendance)
    {
        if ($attendance->check_out) {
            return back()->withErrors(['attendance' => __('すでに下校済みです。')]);
        }

        $attendance->update([
            'check_out' => now(),
        ]);

        return redirect()->route('admin.attendance.index')->with('status', __('下校を記録しました。'));
    }
}
