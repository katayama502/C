@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-indigo-700 mb-6">作品を投稿</h1>
<form action="{{ route('student.works.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white shadow rounded-lg p-6">
    @csrf
    <div>
        <label class="block text-sm font-semibold text-slate-700">タイトル</label>
        <input type="text" name="title" value="{{ old('title') }}" class="mt-1 w-full border-slate-300 rounded" required>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">説明</label>
        <textarea name="description" rows="4" class="mt-1 w-full border-slate-300 rounded">{{ old('description') }}</textarea>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-slate-700">ファイル</label>
            <input type="file" name="file" class="mt-1 w-full border-slate-300 rounded">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700">リンク(URL)</label>
            <input type="url" name="link" value="{{ old('link') }}" class="mt-1 w-full border-slate-300 rounded">
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700">公開設定</label>
        <select name="visibility" class="mt-1 w-full border-slate-300 rounded">
            <option value="private" @selected(old('visibility') === 'private')>非公開</option>
            <option value="parent" @selected(old('visibility') === 'parent')>保護者に公開</option>
            <option value="public" @selected(old('visibility') === 'public')>全体に公開</option>
        </select>
    </div>
    <div class="flex justify-end space-x-3">
        <a href="{{ route('student.works.index') }}" class="px-4 py-2 rounded border border-slate-300">戻る</a>
        <button class="px-4 py-2 rounded bg-indigo-600 text-white">投稿する</button>
    </div>
</form>
@endsection
