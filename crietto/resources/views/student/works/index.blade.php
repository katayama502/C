@extends('layouts.app')
@php use Illuminate\Support\Str; use Illuminate\Support\Facades\Storage; @endphp

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-indigo-700">作品ギャラリー</h1>
    <a href="{{ route('student.works.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">作品を投稿</a>
</div>
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach ($works as $work)
        <article class="bg-white shadow rounded-lg p-5 flex flex-col">
            <h2 class="text-lg font-semibold text-slate-700">{{ $work->title }}</h2>
            <p class="mt-2 text-sm text-slate-600 flex-grow">{{ Str::limit($work->description, 120) }}</p>
            <div class="mt-4 text-xs text-slate-400">{{ $work->created_at->format('Y/m/d') }}</div>
            <div class="mt-4 flex justify-between items-center text-sm">
                <div class="space-x-2">
                    @if ($work->file_path)
                        <a href="{{ Storage::disk('public')->url($work->file_path) }}" class="text-indigo-600 hover:underline" target="_blank">ファイル</a>
                    @endif
                    @if ($work->link)
                        <a href="{{ $work->link }}" class="text-indigo-600 hover:underline" target="_blank">リンク</a>
                    @endif
                </div>
                <div class="space-x-2">
                    <a href="{{ route('student.works.edit', $work) }}" class="text-indigo-600 hover:underline">編集</a>
                    <form action="{{ route('student.works.destroy', $work) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">削除</button>
                    </form>
                </div>
            </div>
        </article>
    @endforeach
</div>
<div class="mt-6">{{ $works->links() }}</div>
@endsection
