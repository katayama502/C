@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-indigo-700 mb-6">保護者ダッシュボード</h1>
<div class="bg-white shadow rounded-lg p-6 mb-6">
    <form method="POST" action="{{ route('parent.notifications.toggle') }}" class="flex items-center justify-between">
        @csrf
        <div>
            <p class="font-semibold">通知設定</p>
            <p class="text-sm text-slate-500">お子さまの新しい投稿や成長記録をメールで受け取ります。</p>
        </div>
        <button class="px-4 py-2 rounded {{ $parent->notification_enabled ? 'bg-indigo-600 text-white' : 'bg-slate-200' }}">
            {{ $parent->notification_enabled ? '通知を停止' : '通知を有効化' }}
        </button>
    </form>
</div>
<div class="grid md:grid-cols-2 gap-5">
    @foreach ($parent->students as $student)
        <article class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold text-indigo-600">{{ $student->user->name }}</h2>
            <p class="text-sm text-slate-500 mt-1">学年: {{ $student->grade ?? '---' }}</p>
            <p class="text-sm text-slate-500">作品数: {{ $student->works->count() }}</p>
            <p class="text-sm text-slate-500">成長記録: {{ $student->growthRecords->count() }}</p>
            <a href="{{ route('parent.children.show', $student) }}" class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded">詳細を見る</a>
        </article>
    @endforeach
</div>
@endsection
