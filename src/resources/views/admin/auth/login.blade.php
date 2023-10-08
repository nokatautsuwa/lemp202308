@extends('admin.app')

@section('component')
    @vite(['resources/sass/auth/auth.scss'])
@endsection

@section('title', 'ログイン')

@section('content')

    <div>

        @if(session('success'))
            <!--処理が成功してリダイレクトしたときに表示する-->
            <p class="alert-success">{{ session('success') }}</p>
        @endif

        <p class='title'>ログイン</p>

        <form method="POST" action="{{ route('admin.login') }}">
                <!---                           ---------------------------------------------->
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

            <!--パスワード(必須/伏字)-->
            <!--パスワードがNULLの場合は未設定のためパスワード登録フォームにリダイレクトさせる-->
            <label>
                パスワード
                <p>* 未登録の方は空欄でログインを押下してください</p>
                <input type="password" name="password">
            </label>
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

            <p class='guide'>
                <a href="{{ route('admin.password') }}">
                    パスワード未登録または忘れた方
                </a>
            </p>

            <p class='submit'>
                <button type="submit">ログイン</button>
            </p>
            <!------------------------------------------------->

        </form>

    </div>

@endsection