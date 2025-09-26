@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-indigo-700">成長記録</h1>
    <a href="{{ route('student.growth-records.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">新規投稿</a>
</div>
<div class="space-y-4">
    @foreach ($records as $record)
        <article class="bg-white shadow rounded-lg p-5">
            <div class="flex justify-between">
                <p class="text-sm text-slate-500">{{ $record->created_at->format('Y/m/d H:i') }}</p>
                <div class="space-x-2">
                    <a href="{{ route('student.growth-records.edit', $record) }}" class="text-indigo-600 hover:underline">編集</a>
                    <form action="{{ route('student.growth-records.destroy', $record) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">削除</button>
                    </form>
                </div>
            </div>
            <p class="mt-3 whitespace-pre-line">{{ $record->content }}</p>
            <div class="mt-2 text-sm text-slate-500 flex space-x-4">
                <span>気分: {{ $record->mood ?? '---' }}</span>
                <span>学習時間: {{ $record->learning_time ? $record->learning_time.'分' : '---' }}</span>
            </div>
        </article>
    @endforeach
</div>
<div class="mt-6">{{ $records->links() }}</div>
@endsection
