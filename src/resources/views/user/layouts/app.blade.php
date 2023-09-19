<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


    <head>

        <!-- metaタグ/linkタグ/CDN -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CDNのreset.css(ress.css)URLを入力-->
        <link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">

        <!-- Reactコンポーネント/SCSS読み込み/タイトル -->
        @viteReactRefresh
        @vite(['resources/sass/user/app.scss'])
        @if (strpos(url()->current(), 'login') !== false || strpos(url()->current(), 'register') !== false)
        <!-- URLに'login''register'が含まれる場合のみ(ログイン/新規登録フォーム) -->
            @vite(['resources/sass/user/auth.scss'])
        @endif

        <title>RES | @yield('title')</title>

    </head>


    <body>

        @if (strpos(url()->current(), 'login') === false && strpos(url()->current(), 'register') === false)
        <!-- URLに'login''register'どちらも含まれない場合のみ -->

            <!--ヘッダー-->
            <header>
                <!-- グローバルナビ -->
                <nav>

                    <div>
                        @include('user.layouts.menu')
                    </div>

                </nav>
            </header>

        @endif

        <!--メイン-->
        <main>
            @yield('content')
        </main>

    </body>


    <script src="{{ asset('js/script.js') }}"></script>


    <!--フッター-->
    <footer>
        chat service RES All rights reserved.
    </footer>


</html>
