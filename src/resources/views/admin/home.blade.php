@extends('admin.layouts.app')

@section('title', 'ホーム')

@section('content')

@if(session('success'))

    <!--処理が成功してリダイレクトしたときに表示する-->
    <p class="alert-success">
        {{ session('success') }}
    </p>

@endif

    <article>

        <section>

            <p>Admin Home.</p>

        <section>

        <section>

            @foreach ($users as $user)
                <p>{{ $user->id }}: {{ $user->name }} ({{ '@' }}{{ $user->account_id }})</p>
            @endforeach

        <section>

    </article>

@endsection