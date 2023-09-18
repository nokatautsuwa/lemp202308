@extends('user.layouts.app')

@section('title', 'ホーム')

@section('content')
@if(session('success'))
    <!--処理が成功してリダイレクトしたときに表示する-->
    <p class="alert-success">
        {{ session('success') }}
    </p>
@endif
<p>User Home.</p>
@if (Auth::guard('user')->check())
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
            ログアウト
        </button>
    </form>
@else
    <a href="{{ route('login') }}">
        ログイン
    </a>
    <a href="{{ route('register') }}">
        新規登録
    </a>
@endif
@endsection
