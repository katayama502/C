@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-indigo-700 mb-6">保護者の追加</h1>
<form method="POST" action="{{ route('admin.parents.store') }}" class="space-y-4 bg-white shadow rounded-lg p-6">
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
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-slate-700">電話番号</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 w-full border-slate-300 rounded">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700">住所</label>
            <input type="text" name="address" value="{{ old('address') }}" class="mt-1 w-full border-slate-300 rounded">
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">子どもを選択</label>
        <div class="grid md:grid-cols-2 gap-2">
            @foreach ($students as $student)
                <label class="flex items-center space-x-2 border border-slate-200 rounded px-3 py-2">
                    <input type="checkbox" name="students[]" value="{{ $student->id }}" @checked(in_array($student->id, old('students', [])))>
                    <span>{{ $student->user->name }}</span>
                </label>
            @endforeach
        </div>
    </div>
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.parents.index') }}" class="px-4 py-2 rounded border border-slate-300">戻る</a>
        <button class="px-4 py-2 rounded bg-indigo-600 text-white">保存</button>
    </div>
</form>
@endsection
