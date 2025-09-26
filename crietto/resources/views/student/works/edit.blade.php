@extends('layouts.app')
@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
<h1 class="text-2xl font-semibold text-indigo-700 mb-6">作品を編集</h1>
<form action="{{ route('student.works.update', $work) }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white shadow rounded-lg p-6">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm font-semibold text-slate-700">タイトル</label>
        <input type="text" name="title" value="{{ old('title', $work->title) }}" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">説明</label>
        <textarea name="description" rows="4" class="mt-1 w-full border-slate-300 rounded">{{ old('description', $work->description) }}</textarea>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-slate-700">ファイル</label>
            <input type="file" name="file" class="mt-1 w-full border-slate-300 rounded">
            @if ($work->file_path)
                <p class="text-xs text-slate-500 mt-1">現在のファイル: <a href="{{ Storage::disk('public')->url($work->file_path) }}" target="_blank" class="text-indigo-600 hover:underline">ダウンロード</a></p>
            @endif
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700">リンク(URL)</label>
            <input type="url" name="link" value="{{ old('link', $work->link) }}" class="mt-1 w-full border-slate-300 rounded">
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">公開設定</label>
        <select name="visibility" class="mt-1 w-full border-slate-300 rounded">
            <option value="private" @selected(old('visibility', $work->visibility) === 'private')>非公開</option>
            <option value="parent" @selected(old('visibility', $work->visibility) === 'parent')>保護者に公開</option>
            <option value="public" @selected(old('visibility', $work->visibility) === 'public')>全体に公開</option>
        </select>
    </div>
    <div class="flex justify-end space-x-3">
        <a href="{{ route('student.works.index') }}" class="px-4 py-2 rounded border border-slate-300">戻る</a>
        <button class="px-4 py-2 rounded bg-indigo-600 text-white">更新する</button>
    </div>
</form>
@endsection
