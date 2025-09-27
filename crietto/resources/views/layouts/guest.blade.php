<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'クリエット') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-white to-pink-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">
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

        @yield('content')
    </div>
</body>
</html>
