@extends('admin.layouts.app')

@section('title', 'ログイン')

@section('content')
    <section class='auth'>

        @if(session('success'))
            <!--処理が成功してリダイレクトしたときに表示する-->
            <p class="alert-success">
                {{ session('success') }}
            </p>
        @endif

        <p class='title'>ログイン</p>

        <form method="POST" action="{{ route('admin.login.attempt') }}">
            <!------------------------------------------------->
            <!--CSRFトークン-->
            @csrf

            <!--メールアドレス or ユーザー名(必須/既存レコードと同じものは不可)-->
            <p>
                <label for="account">
                    メールアドレス or 名前
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
                <button><a href="{{ route('admin.register') }}">未登録の方</a></button>
            </div>
            <!------------------------------------------------->

        </form>

    </section>
@endsection