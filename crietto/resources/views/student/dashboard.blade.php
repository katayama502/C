@extends('layouts.app')
@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="grid gap-6 md:grid-cols-2">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold text-indigo-600">プロフィール</h2>
        <div class="flex items-center space-x-4 mt-4">
            <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center text-2xl">
                {{ $student->user->name[0] ?? '学' }}
            </div>
            <div>
                <p class="text-xl font-bold">{{ $student->user->name }}</p>
                <p class="text-sm text-slate-500">学年: {{ $student->grade ?? '未設定' }}</p>
                <p class="text-sm text-slate-500">投稿バッジ: {{ $badgeCount }}個</p>
                <p class="text-sm text-slate-500">次のバッジまであと {{ max($nextBadgeThreshold - ($student->works->count() + $student->growthRecords->count()), 0) }} 投稿</p>
            </div>
        </div>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold text-indigo-600">最新の作品</h2>
        <ul class="mt-4 space-y-3">
            @forelse ($student->works->take(5) as $work)
                <li class="border border-slate-200 rounded p-4">
                    <h3 class="font-semibold">{{ $work->title }}</h3>
                    <p class="text-sm text-slate-600">{{ Str::limit($work->description, 80) }}</p>
                </li>
            @empty
                <li class="text-sm text-slate-500">まだ作品がありません。</li>
            @endforelse
        </ul>
    </div>
    <div class="bg-white shadow rounded-lg p-6 md:col-span-2">
        <h2 class="text-lg font-semibold text-indigo-600">最新の成長記録</h2>
        <ul class="mt-4 space-y-3">
            @forelse ($student->growthRecords->take(5) as $record)
                <li class="border border-slate-200 rounded p-4">
                    <p class="text-sm text-slate-600">{{ $record->created_at->format('Y/m/d') }}</p>
                    <p>{{ Str::limit($record->content, 120) }}</p>
                </li>
            @empty
                <li class="text-sm text-slate-500">まだ学習記録がありません。</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
