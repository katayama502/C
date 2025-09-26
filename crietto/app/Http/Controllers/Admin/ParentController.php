<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentProfile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ParentController extends Controller
{
    public function index()
    {
        $parents = ParentProfile::with('user', 'students')->paginate();
        return view('admin.parents.index', compact('parents'));
    }

    public function create()
    {
        $students = Student::with('user')->get();
        return view('admin.parents.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'students' => ['nullable', 'array'],
            'students.*' => ['exists:students,id'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => User::ROLE_PARENT,
        ]);

        $profile = $user->parentProfile()->create([
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'notification_enabled' => true,
        ]);

        $profile->students()->sync($validated['students'] ?? []);

        return redirect()->route('admin.parents.index')->with('status', __('保護者アカウントを作成しました。'));
    }

    public function edit(ParentProfile $parent)
    {
        $parent->load('user', 'students');
        $students = Student::with('user')->get();
        return view('admin.parents.edit', compact('parent', 'students'));
    }

    public function update(Request $request, ParentProfile $parent)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($parent->user_id)],
            'password' => ['nullable', 'string', 'min:8'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'notification_enabled' => ['nullable', 'boolean'],
            'students' => ['nullable', 'array'],
            'students.*' => ['exists:students,id'],
        ]);

        $parent->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $parent->user->password,
        ]);

        $parent->update([
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'notification_enabled' => $validated['notification_enabled'] ?? $parent->notification_enabled,
        ]);

        $parent->students()->sync($validated['students'] ?? []);

        return redirect()->route('admin.parents.index')->with('status', __('保護者アカウントを更新しました。'));
    }

    public function destroy(ParentProfile $parent)
    {
        $parent->user()->delete();
        return redirect()->route('admin.parents.index')->with('status', __('保護者アカウントを削除しました。'));
    }
}
