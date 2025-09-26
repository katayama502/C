@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-indigo-700 mb-6">生徒の追加</h1>
<form method="POST" action="{{ route('admin.students.store') }}" class="space-y-4 bg-white shadow rounded-lg p-6">
    @csrf
    <div>
        <label class="block text-sm font-semibold text-slate-700">名前</label>
        <input type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">メール</label>
        <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">パスワード</label>
        <input type="password" name="password" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">学年</label>
        <input type="number" name="grade" value="{{ old('grade') }}" min="1" max="9" class="mt-1 w-full border-slate-300 rounded">
    </div>
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.students.index') }}" class="px-4 py-2 rounded border border-slate-300">戻る</a>
        <button class="px-4 py-2 rounded bg-indigo-600 text-white">保存</button>
    </div>
</form>
@endsection
