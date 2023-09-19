@extends('user.layouts.app')

@section('title', '新規登録')

@section('content')

    <article>

        <section>

            <p class='title'>新規登録</p>

            <form method="POST" action="{{ route('register.add') }}">
                <!------------------------------------------------->
                <!--CSRFトークン-->
                @csrf

                <!--アカウント名: マイページに表示される名前-->
                <label for="name">アカウント名</label>
                <input type="text" name="name">
                <!--エラーハンドリング-->
                @if ($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif

                <!--アカウントID: マイページurlの末尾/メンションid/ログイン認証等に使う-->
                <label for="account_id">アカウントID</label>
                <input type="text" name="account_id">
                <!--エラーハンドリング-->
                @if ($errors->has('account_id'))
                    <p class="help-block">
                        {{ $errors->first('account_id') }}
                    </p>
                @endif

                <!--メールアドレス-->
                <label for="email">メールアドレス</label>
                <input type="text" name="email">
                <!--エラーハンドリング-->
                @if ($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif

                <!--パスワード: 伏字-->
                <label for="password">パスワード</label>
                <input type="password" name="password">
                <!--エラーハンドリング-->
                @if ($errors->has('password'))
                    <p class="help-block">
                        {{ $errors->first('password') }}
                    </p>
                @endif

                <!--パスワード: 伏字-->
                <label for="password-confirm">パスワード確認</label>
                <input type="password" name="password-confirm">
                <!--エラーハンドリング-->
                @if ($errors->has('password-confirm'))
                    <p class="help-block">
                        {{ $errors->first('password-confirm') }}
                    </p>
                @endif

                <div class='submit'>
                    <button type="submit">登録</button>
                    <a href="{{ route('login') }}">登録済の方はこちら</a>
                </div>
                <!------------------------------------------------->

            </form>

        </section>

    </article>

@endsection



