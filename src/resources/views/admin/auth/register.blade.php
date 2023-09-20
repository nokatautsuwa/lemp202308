@extends('admin.layouts.app')

@section('component')
    @vite(['resources/sass/admin/auth.scss'])
@endsection

@section('title', '新規登録')

@section('content')

    <article>

        <section>

            <p class='title'>新規登録</p>

            <form method="POST" action="{{ route('admin.register.add') }}">
                <!------------------------------------------------->
                <!--CSRFトークン-->
                @csrf

                <!--アカウント名: マイページに表示される名前-->
                <label for="name">名前</label>
                <input type="text" name="name">
                <!--エラーハンドリング-->
                @if ($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
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

                <!--権限設定-->
                <!--チェックボックスが選択された状態でリクエスト送信された時にvalueの値を渡す-->
                <div class='check'>
                    <!--User管理権限-->
                    <label>
                        <input type="checkbox"  name="user-authority" value=1 class='checkbox'>
                        ユーザー管理権限の付与
                    </label>

                    <!--Admin管理権限-->
                    <label>
                        <input type="checkbox" name="admin-authority" value=1 class='checkbox'>
                        管理者権限の付与
                    </label>
                </div>

                <div class='submit'>
                    <button type="submit">登録</button>
                    <a href="{{ route('admin.login') }}">登録済の方</a>
                </div>
                <!------------------------------------------------->

            </form>

        </section>

    </article>

@endsection
