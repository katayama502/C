<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'クリエット') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">
    @php use Illuminate\Support\Facades\Auth; @endphp
    <header class="bg-indigo-600 text-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold">{{ config('app.name', 'クリエット') }}</h1>
            <nav class="space-x-4 text-sm">
                @auth
                    @if (Auth::user()->isStudent())
                        <a href="{{ route('student.dashboard') }}" class="hover:underline">マイページ</a>
                        <a href="{{ route('student.growth-records.index') }}" class="hover:underline">成長記録</a>
                        <a href="{{ route('student.works.index') }}" class="hover:underline">作品</a>
                        <a href="{{ route('student.attendance.index') }}" class="hover:underline">出席</a>
                    @elseif(Auth::user()->isParent())
                        <a href="{{ route('parent.dashboard') }}" class="hover:underline">子どもの記録</a>
                    @elseif(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:underline">ダッシュボード</a>
                        <a href="{{ route('admin.students.index') }}" class="hover:underline">生徒管理</a>
                        <a href="{{ route('admin.parents.index') }}" class="hover:underline">保護者管理</a>
                        <a href="{{ route('admin.attendance.index') }}" class="hover:underline">出席管理</a>
                        <a href="{{ route('admin.statistics.index') }}" class="hover:underline">統計</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="ml-4 bg-white/20 hover:bg-white/30 px-3 py-1 rounded">ログアウト</button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>
    <main class="max-w-7xl mx-auto py-10 px-4">
        @if (session('status'))
            <div class="mb-6 bg-green-100 border border-green-300 text-green-900 px-4 py-3 rounded">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-300 text-red-900 px-4 py-3 rounded">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{ $slot ?? '' }}
        @yield('content')
    </main>
</body>
</html>
