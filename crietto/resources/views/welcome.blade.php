@extends('layouts.guest')

@section('content')
<div class="text-center space-y-6">
    <h1 class="text-3xl font-bold text-indigo-700">ようこそ、クリエットへ！</h1>
    <p class="text-slate-600">小中学生のためのプログラミングスクール管理システムです。</p>
    <div class="space-x-4">
        <a href="{{ route('register') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">新規登録</a>
        <a href="{{ route('login') }}" class="inline-block bg-white border border-indigo-600 text-indigo-600 px-4 py-2 rounded hover:bg-indigo-50">ログイン</a>
    </div>
</div>
@endsection
