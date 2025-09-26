@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-indigo-700 mb-6">成長記録の投稿</h1>
<form action="{{ route('student.growth-records.store') }}" method="POST" class="space-y-4 bg-white shadow rounded-lg p-6">
    @csrf
    <div>
        <label class="block text-sm font-semibold text-slate-700">今日の学び</label>
        <textarea name="content" rows="6" class="mt-1 w-full border-slate-300 rounded" required>{{ old('content') }}</textarea>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-slate-700">気分</label>
            <input type="text" name="mood" value="{{ old('mood') }}" class="mt-1 w-full border-slate-300 rounded">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700">学習時間 (分)</label>
            <input type="number" name="learning_time" value="{{ old('learning_time') }}" class="mt-1 w-full border-slate-300 rounded" min="0">
        </div>
    </div>
    <div class="flex justify-end space-x-3">
        <a href="{{ route('student.growth-records.index') }}" class="px-4 py-2 rounded border border-slate-300">戻る</a>
        <button class="px-4 py-2 rounded bg-indigo-600 text-white">投稿する</button>
    </div>
</form>
@endsection
