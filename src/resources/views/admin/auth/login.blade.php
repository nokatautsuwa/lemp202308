@extends('admin.layouts.app')

@section('component')
    @vite(['resources/sass/admin/auth.scss'])
@endsection

@section('title', 'ログイン')

@section('content')

    <article>

        @if(session('success'))
            <!--処理が成功してリダイレクトしたときに表示する-->
            <p class="alert-success">{{ session('success') }}</p>
        @endif

        <section>

            <p class='title'>ログイン</p>

            <form method="POST" action="{{ route('admin.login.attempt') }}">
                <!------------------------------------------------->
                <!--CSRFトークン-->
                @csrf

                <!--メールアドレス or ユーザー名(必須/既存レコードと同じものは不可)-->
                <label for="account">メールアドレス or 名前</label>
                <input type="text" name="account">
                <!--エラーハンドリング-->
                @if ($errors->has('account'))
                    <p class="help-block">
                        {{ $errors->first('account') }}
                    </p>
                @endif

                <!--パスワード(必須/伏字)-->
                <label for="password">パスワード</label>
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

                <div class='submit'>
                    <button type="submit">ログイン</button>
                    <a href="{{ route('admin.register') }}">未登録の方</a>
                </div>
                <!------------------------------------------------->

            </form>

        </section>

    </article>

@endsection