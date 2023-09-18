@extends('user.layouts.app')

@section('title', '新規登録')

@section('content')
    <section class='auth'>

        <p class='title'>新規登録</p>

        <form method="POST" action="{{ route('register.add') }}">
            <!------------------------------------------------->
            <!--CSRFトークン-->
            @csrf

            <!--アカウント名: マイページに表示される名前-->
            <p><label for="name">アカウント名</label></p>
            <div class='input-form'>
                <input type="text" name="name">
                <!--エラーハンドリング-->
                @if ($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
            </div>

            <!--アカウントID: マイページurlの末尾/メンションid/ログイン認証等に使う-->
            <p><label for="account_id">アカウントID</label></p>
            <div class='input-form'>
                <input type="text" name="account_id">
                <!--エラーハンドリング-->
                @if ($errors->has('account_id'))
                    <p class="help-block">
                        {{ $errors->first('account_id') }}
                    </p>
                @endif
            </div>

            <!--メールアドレス-->
            <p><label for="email">メールアドレス</label></p>
            <div class='input-form'>
                <input type="text" name="email">
                <!--エラーハンドリング-->
                @if ($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>

            <!--パスワード: 伏字-->
            <p><label for="password">パスワード</label></p>
            <div class='input-form'>
                <input type="password" name="password">
                <!--エラーハンドリング-->
                @if ($errors->has('password'))
                    <p class="help-block">
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </div>

            <!--パスワード: 伏字-->
            <p><label for="password-confirm">パスワード確認</label></p>
            <div class='input-form'>
                <input type="password" name="password-confirm">
                <!--エラーハンドリング-->
                @if ($errors->has('password-confirm'))
                    <p class="help-block">
                        {{ $errors->first('password-confirm') }}
                    </p>
                @endif
            </div>

            <div class='submit'>
                <button type="submit">登録</button>
            </div>
            <!------------------------------------------------->

        </form>

        <p class='return'>
            <a href="{{ route('login') }}">登録済の方はこちら</a>
        </p>

    </section>
@endsection



