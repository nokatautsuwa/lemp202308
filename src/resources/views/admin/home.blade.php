@extends('admin.layouts.app')

@section('title', 'ホーム')

@section('content')

@if(session('success'))

    <!--処理が成功してリダイレクトしたときに表示する-->
    <p class="alert-success">
        {{ session('success') }}
    </p>

@endif

    <p>Admin Home.</p>
    @foreach ($users as $user)
        <p>
            {{ $user->id }}: {{ $user->name }} ({{ '@' }}{{ $user->account_id }})
        </p>
    @endforeach
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit">
            ログアウト
        </button>
    </form>

@endsection