@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-indigo-700">生徒管理</h1>
    <a href="{{ route('admin.students.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">生徒を追加</a>
</div>
<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">名前</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">メール</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">学年</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">操作</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach ($students as $student)
                <tr>
                    <td class="px-4 py-3 text-sm">{{ $student->user->name }}</td>
                    <td class="px-4 py-3 text-sm">{{ $student->user->email }}</td>
                    <td class="px-4 py-3 text-sm">{{ $student->grade ?? '---' }}</td>
                    <td class="px-4 py-3 text-sm space-x-3">
                        <a href="{{ route('admin.students.edit', $student) }}" class="text-indigo-600 hover:underline">編集</a>
                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $students->links() }}</div>
@endsection
