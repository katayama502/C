@extends('layouts.guest')

@section('content')
<h1 class="text-2xl font-semibold text-center text-indigo-700 mb-6">パスワード再設定</h1>
<form method="POST" action="{{ route('password.email') }}" class="space-y-4">
    @csrf
    <div>
        <label class="block text-sm font-semibold text-slate-700">メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <button class="w-full bg-indigo-600 text-white py-2 rounded">再設定リンクを送信</button>
</form>
@endsection
