<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ParentProfile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:'.implode(',', [User::ROLE_PARENT, User::ROLE_STUDENT])],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        if ($user->isStudent()) {
            Student::create(['user_id' => $user->id]);
        } elseif ($user->isParent()) {
            ParentProfile::create(['user_id' => $user->id]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended($this->redirectTo($user))
            ->with('status', 'アカウントの作成が完了しました。ようこそ！');
    }

    private function redirectTo(User $user): string
    {
        if ($user->isAdmin()) {
            return route('admin.dashboard');
        }

        if ($user->isParent()) {
            return route('parent.dashboard');
        }

        return route('student.dashboard');
    }
}
