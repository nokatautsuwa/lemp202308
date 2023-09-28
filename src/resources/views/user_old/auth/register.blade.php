@extends('user.layouts.app')

@section('component')
    @vite(['resources/sass/user/auth.scss'])
@endsection

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
                <label>
                    アカウント名
                    <input type='text' name="name">
                </label>
                <!--エラーハンドリング-->
                @if ($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif

                <!--アカウントID: マイページurlの末尾/メンションid/ログイン認証等に使う-->
                <label>
                    アカウントID
                    <input type="text" name="account_id">
                </label>
                <!--エラーハンドリング-->
                @if ($errors->has('account_id'))
                    <p class="help-block">
                        {{ $errors->first('account_id') }}
                    </p>
                @endif

                <!--メールアドレス-->
                <label>
                    メールアドレス
                    <input type="text" name="email">
                </label>
                <!--エラーハンドリング-->
                @if ($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif

                <!--パスワード: 伏字-->
                <label>
                    パスワード
                    <input type="password" name="password">
                </label>
                <!--エラーハンドリング-->
                @if ($errors->has('password'))
                    <p class="help-block">
                        {{ $errors->first('password') }}
                    </p>
                @endif

                <!--パスワード: 伏字-->
                <label>
                    パスワード確認
                    <input type="password" name="password-confirm">
                </label>
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



