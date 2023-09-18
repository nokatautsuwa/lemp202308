@extends('user.layouts.app')

@section('title', 'ログイン')

@section('content')
    <section class='auth'>

        <!--DELETEメソッドでリダイレクトしたときに表示する-->
        @if(session('success'))
            <p class="alert-success">{{ session('success') }}</p>
        @endif

        <p class='title'>ログイン</p>

        <form method="POST" action="{{ route('login.attempt') }}">
            <!------------------------------------------------->
            <!--CSRFトークン-->
            @csrf

            <!--メールアドレス or アカウントID(必須/既存レコードと同じものは不可)-->
            <p>
                <label for="account">
                    メールアドレス or アカウントID
                </label>
            </p>
            <div class="input-form">
                <input type="text" name="account">
                <!--エラーハンドリング-->
                @if ($errors->has('account'))
                    <p class="help-block">
                        {{ $errors->first('account') }}
                    </p>
                @endif
            </div>

            <!--パスワード(必須/伏字)-->
            <p><label for="password">パスワード</label></p>
            <div class="input-form">
                <input type="password" name="password">
                <!--エラーハンドリング-->
                @if ($errors->has('password'))
                    <p class="help-block">
                        {{ $errors->first('password') }}
                    </p>
                @endif
                <!--エラーハンドリング(ログインセッションエラー)-->
                @if (session('error'))
                    <p class="help-block">
                        {{ session('error') }}
                    </p>
                @endif
            </div>

            <div class='submit'>
                <button type="submit">ログイン</button>
                <button><a href="{{ route('register') }}">未登録の方はこちら</a></button>
            </div>
            <!------------------------------------------------->

        </form>

    </section>
@endsection
