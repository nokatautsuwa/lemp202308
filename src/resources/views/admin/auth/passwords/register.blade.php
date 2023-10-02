@extends('admin.app')

@section('component')
    @vite(['resources/sass/auth/auth.scss'])
@endsection

@section('title', 'パスワード登録')

@section('content')

    <article>

        <section>

            <p class='title'>パスワード登録</p>

            @if(session('success'))
                <!--処理が成功してリダイレクトしたときに表示する-->
                <p class="alert-success">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('admin.password.add') }}">
                <!------------------------------------------------->
                <!--CSRFトークン-->
                @csrf

                <!--メールアドレス or ユーザー名(必須/既存レコードと同じものは不可)-->
                <label>
                    メールアドレス or 名前
                    <input type="text" name="account">
                </label>
                <!--エラーハンドリング-->
                @if ($errors->has('account'))
                    <p class="help-block">
                        {{ $errors->first('account') }}
                    </p>
                @endif

                <!--パスワード: 伏字-->
                <label>
                    パスワード(半角英数字含む8文字以上)
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
                    <button type="submit">パスワード再登録</button>
                </div>

                <p class='guide'>
                    <a href="{{ route('admin.login') }}">
                        ログイン画面に戻る
                    </a>
                </p>
                <!------------------------------------------------->

            </form>

        </section>

    </article>

@endsection