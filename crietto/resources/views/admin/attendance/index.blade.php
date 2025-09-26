@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-indigo-700 mb-6">出席管理</h1>
<div class="bg-white shadow rounded-lg p-6 mb-6">
    <form method="POST" action="{{ route('admin.attendance.check-in') }}" class="flex flex-wrap gap-3 items-end">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-slate-700">生徒を選択</label>
            <select name="student_id" class="mt-1 border-slate-300 rounded">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->user->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded">登校を記録</button>
    </form>
</div>
<div class="bg-white shadow rounded-lg overflow-x-auto">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">生徒</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">登校</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">下校</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">操作</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach ($attendances as $attendance)
                <tr>
                    <td class="px-4 py-3 text-sm">{{ $attendance->student->user->name }}</td>
                    <td class="px-4 py-3 text-sm">{{ optional($attendance->check_in)->format('Y/m/d H:i') }}</td>
                    <td class="px-4 py-3 text-sm">{{ optional($attendance->check_out)->format('Y/m/d H:i') ?? '---' }}</td>
                    <td class="px-4 py-3 text-sm">
                        @if (! $attendance->check_out)
                            <form method="POST" action="{{ route('admin.attendance.check-out', $attendance) }}">
                                @csrf
                                <button class="px-3 py-1 text-white bg-emerald-500 rounded">下校を記録</button>
                            </form>
                        @else
                            <span class="text-slate-400">完了</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $attendances->links() }}</div>
@endsection
