<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $parent = Auth::user()->parentProfile()->with(['students.works', 'students.growthRecords', 'students.attendances'])->firstOrFail();
        return view('parent.dashboard', compact('parent'));
    }

    public function showStudent(Student $student)
    {
        $this->authorize('view', $student);
        $student->load(['works', 'growthRecords', 'attendances']);
        return view('parent.students.show', compact('student'));
    }

    public function toggleNotifications()
    {
        $parentProfile = Auth::user()->parentProfile()->firstOrFail();
        $parentProfile->update([
            'notification_enabled' => ! $parentProfile->notification_enabled,
        ]);

        return back()->with('status', __('通知設定を更新しました。'));
    }
}
