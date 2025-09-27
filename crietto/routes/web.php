<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\ParentController as AdminParentController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Parents\DashboardController as ParentDashboardController;
use App\Http\Controllers\Student\AttendanceController as StudentAttendanceController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\GrowthRecordController as StudentGrowthRecordController;
use App\Http\Controllers\Student\WorkController as StudentWorkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])
        ->middleware('can:view-student-dashboard')->name('student.dashboard');

    Route::get('/parent/dashboard', [ParentDashboardController::class, 'index'])
        ->middleware('can:view-parent-dashboard')->name('parent.dashboard');

    Route::prefix('student')->name('student.')->middleware('can:view-student-dashboard')->group(function () {
        Route::resource('growth-records', StudentGrowthRecordController::class);
        Route::resource('works', StudentWorkController::class);
        Route::get('attendance', [StudentAttendanceController::class, 'index'])->name('attendance.index');
    });

    Route::prefix('parent')->name('parent.')->middleware('can:view-parent-dashboard')->group(function () {
        Route::get('children/{student}', [ParentDashboardController::class, 'showStudent'])->name('children.show');
        Route::post('notifications/toggle', [ParentDashboardController::class, 'toggleNotifications'])->name('notifications.toggle');
    });

    Route::prefix('admin')->name('admin.')->middleware('can:view-admin-dashboard')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('students', AdminStudentController::class);
        Route::resource('parents', AdminParentController::class);
        Route::get('attendance', [AdminAttendanceController::class, 'index'])->name('attendance.index');
        Route::post('attendance/check-in', [AdminAttendanceController::class, 'checkIn'])->name('attendance.check-in');
        Route::post('attendance/{attendance}/check-out', [AdminAttendanceController::class, 'checkOut'])->name('attendance.check-out');
        Route::get('statistics', [StatisticsController::class, 'index'])->name('statistics.index');
    });
});

require __DIR__.'/auth.php';
