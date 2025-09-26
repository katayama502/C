<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->paginate();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'grade' => ['nullable', 'integer', 'min:1', 'max:9'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => User::ROLE_STUDENT,
        ]);

        $user->student()->create([
            'grade' => $validated['grade'] ?? null,
        ]);

        return redirect()->route('admin.students.index')->with('status', __('生徒アカウントを作成しました。'));
    }

    public function edit(Student $student)
    {
        $student->load('user');
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($student->user_id)],
            'password' => ['nullable', 'string', 'min:8'],
            'grade' => ['nullable', 'integer', 'min:1', 'max:9'],
        ]);

        $student->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $student->user->password,
        ]);

        $student->update([
            'grade' => $validated['grade'] ?? null,
        ]);

        return redirect()->route('admin.students.index')->with('status', __('生徒アカウントを更新しました。'));
    }

    public function destroy(Student $student)
    {
        $student->user()->delete();
        return redirect()->route('admin.students.index')->with('status', __('生徒アカウントを削除しました。'));
    }
}
