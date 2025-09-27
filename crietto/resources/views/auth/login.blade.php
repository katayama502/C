@extends('layouts.guest')

@section('content')
<h1 class="text-2xl font-semibold text-center text-indigo-700 mb-6">ログイン</h1>
<form method="POST" action="{{ route('login') }}" class="space-y-4">
    @csrf
    <div>
        <label class="block text-sm font-semibold text-slate-700">メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full border-slate-300 rounded" required autofocus>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">パスワード</label>
        <input type="password" name="password" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <div class="flex items-center justify-between text-sm">
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="remember">
            <span>ログイン情報を記憶する</span>
        </label>
        <a class="text-indigo-600 hover:underline" href="{{ route('password.request') }}">パスワードをお忘れですか？</a>
    </div>
    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-white text-white py-2 rounded transition-colors duration-200">ログイン</button>
</form>
<div class="mt-4 text-center text-sm">
    <a class="text-indigo-600 hover:underline" href="{{ route('register') }}">アカウントを作成</a>
</div>
@endsection
