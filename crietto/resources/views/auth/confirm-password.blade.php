@extends('layouts.guest')

@section('content')
<h1 class="text-2xl font-semibold text-center text-indigo-700 mb-6">パスワード確認</h1>
<form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
    @csrf
    <div>
        <label class="block text-sm font-semibold text-slate-700">パスワード</label>
        <input type="password" name="password" class="mt-1 w-full border-slate-300 rounded" required autofocus>
    </div>
    <button class="w-full bg-indigo-600 text-white py-2 rounded">確認する</button>
</form>
@endsection
