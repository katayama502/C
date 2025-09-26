@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-indigo-700 mb-6">管理者ダッシュボード</h1>
<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white shadow rounded-lg p-5">
        <p class="text-sm text-slate-500">生徒数</p>
        <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $studentCount }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-5">
        <p class="text-sm text-slate-500">作品数</p>
        <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $workCount }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-5">
        <p class="text-sm text-slate-500">学習記録</p>
        <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $recordCount }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-5">
        <p class="text-sm text-slate-500">本日の出席</p>
        <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $attendanceToday }}</p>
    </div>
</div>
@endsection
