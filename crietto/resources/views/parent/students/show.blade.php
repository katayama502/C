@extends('layouts.app')
@php use Illuminate\Support\Str; use Illuminate\Support\Facades\Storage; @endphp

@section('content')
<h1 class="text-2xl font-semibold text-indigo-700 mb-6">{{ $student->user->name }} さんの記録</h1>
<div class="grid lg:grid-cols-2 gap-6">
    <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold text-indigo-600">最新の成長記録</h2>
        <ul class="mt-4 space-y-4">
            @forelse ($student->growthRecords->take(5) as $record)
                <li class="border border-slate-200 rounded p-4">
                    <p class="text-sm text-slate-500">{{ $record->created_at->format('Y/m/d') }}</p>
                    <p class="mt-2 whitespace-pre-line">{{ $record->content }}</p>
                    <p class="text-xs text-slate-400 mt-2">気分: {{ $record->mood ?? '---' }} / 学習時間: {{ $record->learning_time ? $record->learning_time.'分' : '---' }}</p>
                </li>
            @empty
                <li class="text-sm text-slate-500">記録がまだありません。</li>
            @endforelse
        </ul>
    </section>
    <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold text-indigo-600">最新の作品</h2>
        <ul class="mt-4 space-y-4">
            @forelse ($student->works->take(5) as $work)
                <li class="border border-slate-200 rounded p-4">
                    <p class="font-semibold">{{ $work->title }}</p>
                    <p class="text-sm text-slate-600 mt-1">{{ Str::limit($work->description, 120) }}</p>
                    <div class="mt-2 space-x-3 text-sm">
                        @if ($work->file_path)
                            <a href="{{ Storage::disk('public')->url($work->file_path) }}" target="_blank" class="text-indigo-600 hover:underline">ファイルを見る</a>
                        @endif
                        @if ($work->link)
                            <a href="{{ $work->link }}" target="_blank" class="text-indigo-600 hover:underline">リンク</a>
                        @endif
                    </div>
                </li>
            @empty
                <li class="text-sm text-slate-500">作品がまだありません。</li>
            @endforelse
        </ul>
    </section>
    <section class="bg-white shadow rounded-lg p-6 lg:col-span-2">
        <h2 class="text-lg font-semibold text-indigo-600">出席状況</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full mt-4 divide-y divide-slate-200">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">日付</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">登校</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">下校</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">メモ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($student->attendances->take(10) as $attendance)
                        <tr>
                            <td class="px-4 py-3 text-sm">{{ optional($attendance->check_in)->format('Y/m/d') }}</td>
                            <td class="px-4 py-3 text-sm">{{ optional($attendance->check_in)->format('H:i') }}</td>
                            <td class="px-4 py-3 text-sm">{{ optional($attendance->check_out)->format('H:i') ?? '---' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $attendance->notes ?? '---' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-sm text-slate-500">出席データがまだありません。</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
