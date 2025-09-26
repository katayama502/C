@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-indigo-700 mb-6">出席記録</h1>
<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">日付</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">登校</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">下校</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">メモ</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($attendances as $attendance)
                <tr>
                    <td class="px-4 py-3 text-sm">{{ optional($attendance->check_in)->format('Y/m/d') }}</td>
                    <td class="px-4 py-3 text-sm">{{ optional($attendance->check_in)->format('H:i') }}</td>
                    <td class="px-4 py-3 text-sm">{{ optional($attendance->check_out)->format('H:i') ?? '---' }}</td>
                    <td class="px-4 py-3 text-sm">{{ $attendance->notes ?? '---' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-sm text-slate-500">まだ出席記録がありません。</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $attendances->links() }}</div>
@endsection
