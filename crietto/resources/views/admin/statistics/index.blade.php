@extends('layouts.app')
@php use Illuminate\Support\Str; @endphp

@section('content')
<h1 class="text-2xl font-semibold text-indigo-700 mb-6">統計ダッシュボード</h1>
<div class="grid lg:grid-cols-2 gap-6">
    <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold text-indigo-600">週次出席数</h2>
        <ul class="mt-4 space-y-3">
            @foreach ($attendanceRate as $item)
                <li class="flex justify-between text-sm">
                    <span>{{ $item['week'] }}</span>
                    <span class="font-semibold">{{ $item['attendance'] }} 回</span>
                </li>
            @endforeach
        </ul>
    </section>
    <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold text-indigo-600">投稿トレンド</h2>
        <ul class="mt-4 space-y-3">
            @foreach ($postTrend as $item)
                <li class="text-sm flex justify-between">
                    <span>{{ $item['week'] }}</span>
                    <span class="font-semibold text-indigo-600">作品 {{ $item['works'] }} / 記録 {{ $item['growth_records'] }}</span>
                </li>
            @endforeach
        </ul>
    </section>
    <section class="bg-white shadow rounded-lg p-6 lg:col-span-2">
        <h2 class="text-lg font-semibold text-indigo-600">アクティブな生徒トップ5</h2>
        <table class="min-w-full mt-4 divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">生徒</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">作品</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">成長記録</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($topStudents as $student)
                    <tr>
                        <td class="px-4 py-3 text-sm">{{ $student->user->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $student->works_count }}</td>
                        <td class="px-4 py-3 text-sm">{{ $student->growth_records_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection
