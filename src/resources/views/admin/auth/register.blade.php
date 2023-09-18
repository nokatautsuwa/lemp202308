@extends('admin.layouts.app')

@section('title', '新規登録')

@section('content')

    <section class='auth'>

        <p class='title'>新規登録</p>

        <form method="POST" action="{{ route('admin.register.add') }}">
            <!------------------------------------------------->
            <!--CSRFトークン-->
            @csrf

            <!--アカウント名: マイページに表示される名前-->
            <p><label for="name">名前</label></p>
            <div class='input-form'>
                <input type="text" name="name">
                <!--エラーハンドリング-->
                @if ($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
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

            <!--User管理者設定-->
            <div class='input-form checkbox'>
                <!--チェックボックスが選択された状態でリクエスト送信された時にvalueの値を渡す-->
                <input type="checkbox" id="user-authority" name="user-authority" value=1>
                <p><label for="user-authority">利用ユーザーの編集権限</label></p>
            </div>

            <!--Admin管理者権限設定-->
            <div class='input-form checkbox'>
                <!--チェックボックスが選択された状態でリクエスト送信された時にvalueの値を渡す-->
                <input type="checkbox" id="admin-authority" name="admin-authority" value=1>
                <p><label for="admin-authority">管理者権限の付与</label></p>
            </div>

            <div class='submit'>
                <button type="submit">登録</button>
            </div>
            <!------------------------------------------------->

        </form>

        <p class='return'>
            <a href="{{ route('admin.login') }}">ログイン</a>
        </p>

    </section>

@endsection
