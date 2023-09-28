@extends('admin.app')

@section('component')
    @vite(['resources/sass/auth/auth.scss'])
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
                <label>
                    名前
                    <input type="text" name="name">
                </label>
                <!--エラーハンドリング-->
                @if ($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
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

                <!--権限設定-->
                <!--チェックボックスが選択された状態でリクエスト送信された時にvalueの値を渡す-->
                <div class='check'>
                    <!--User管理権限-->
                    <label>
                        <input type="checkbox" id="user-permission" name="user-permission" value=1 class='checkbox'>
                        利用ユーザーの編集権限
                    </label>

                    <!--Admin管理権限-->
                    <label>
                        <input type="checkbox" id="admin-permission" name="admin-permission" value=1 class='checkbox'>
                        管理者の編集権限
                    </label>
                </div>
                <div class='check'>
                    <!--システム管理者権限-->
                    <label>
                        <input type="checkbox" id="system-permission" name="system-permission" value=1 class='checkbox'>
                        システム管理者権限
                    </label>
                    <p id='description' class="help-block hidden">
                        * 全利用ユーザー及び全管理者の編集権限を持つアカウントとして登録します
                    </p>
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

@section('script')
    <script src="{{ asset('js/permission.js') }}"></script>
@endsection
