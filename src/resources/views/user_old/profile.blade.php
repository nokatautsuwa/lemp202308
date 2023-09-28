@extends('user.layouts.app')

@section('component')
    @vite(['resources/sass/user/profile.scss', 'resources/react/User/Profile.tsx'])
    @if (Auth::guard('user')->check() && $user->account_id === Auth::guard('user')->user()->account_id)
        <!--編集用Reactコンポーネント読み込み(自分のプロフィールページのみ)-->
        @vite(['resources/react/User/Update.tsx'])
    @endif
@endsection

@section('title')
    {{ $user->account_id }}
@endsection

@section('content')

    <article>

        <section id="profile"></section>

        <section>

            @if (Auth::guard('user')->check() && $user->account_id === Auth::guard('user')->user()->account_id)
            <!--ログイン中かつ自分のプロフィール)-->

                <button id='user-edit'>編集</button>

            @else
            <!--ログインしていない又は他人のプロフィール)-->

                <button>フォロー</button>

            @endif

        </section>

    </article>

@endsection
