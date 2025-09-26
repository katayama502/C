@extends('layouts.guest')

@section('content')
<h1 class="text-2xl font-semibold text-center text-indigo-700 mb-6">新しいパスワード</h1>
<form method="POST" action="{{ route('password.store') }}" class="space-y-4">
    @csrf
    <input type="hidden" name="token" value="{{ request()->route('token') }}">
    <div>
        <label class="block text-sm font-semibold text-slate-700">メールアドレス</label>
        <input type="email" name="email" value="{{ old('email', request()->email) }}" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">新しいパスワード</label>
        <input type="password" name="password" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">パスワード確認</label>
        <input type="password" name="password_confirmation" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <button class="w-full bg-indigo-600 text-white py-2 rounded">パスワードを更新</button>
</form>
@endsection
