<!-- resources/views/auth/verify-email.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">メールアドレス確認</h1>

    <p class="mb-4">
        確認メールを <strong>{{ Auth::user()->email }}</strong> に送信しました。<br>
        メール内のリンクをクリックして、登録を完了してください。
    </p>

    @if (session('message'))
    <div class="mb-4 text-green-600">
        {{ session('message') }}
    </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            メールを再送する
        </button>
    </form>
</div>
@endsection