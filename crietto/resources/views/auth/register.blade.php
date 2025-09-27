@extends('layouts.guest')

@section('content')
<h1 class="text-2xl font-semibold text-center text-indigo-700 mb-6">アカウント作成</h1>
<form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf
    <div>
        <label class="block text-sm font-semibold text-slate-700">氏名</label>
        <input type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full border-slate-300 rounded" required autofocus>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">パスワード</label>
        <input type="password" name="password" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">パスワード確認</label>
        <input type="password" name="password_confirmation" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">ユーザー種別</label>
        <select name="role" class="mt-1 w-full border-slate-300 rounded" required>
            <option value="student" @selected(old('role') === 'student')>生徒</option>
            <option value="parent" @selected(old('role') === 'parent')>保護者</option>
        </select>
    </div>
    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-white text-white py-2 rounded transition-colors duration-200">登録する</button>
</form>
<div class="mt-4 text-center text-sm">
    <a class="text-indigo-600 hover:underline" href="{{ route('login') }}">すでにアカウントをお持ちですか？</a>
</div>
@endsection
