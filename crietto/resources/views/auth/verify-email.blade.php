@extends('layouts.guest')

@section('content')
<h1 class="text-2xl font-semibold text-center text-indigo-700 mb-4">メールアドレスの確認</h1>
<p class="text-sm text-slate-600 mb-6 text-center">登録時に送信された確認メールをご確認ください。メールが届かない場合は以下から再送信できます。</p>
<form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
    @csrf
    <button class="w-full bg-indigo-600 text-white py-2 rounded">確認メールを再送信</button>
</form>
<form method="POST" action="{{ route('logout') }}" class="mt-4 text-center">
    @csrf
    <button class="text-sm text-slate-500 underline">ログアウト</button>
</form>
@endsection
