<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => __('メールアドレスまたはパスワードが正しくありません。'),
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended($this->redirectTo())
            ->with('status', 'ログインに成功しました。ようこそ！');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function redirectTo(): string
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return route('admin.dashboard');
        }

        if ($user->isParent()) {
            return route('parent.dashboard');
        }

        return route('student.dashboard');
    }
}
