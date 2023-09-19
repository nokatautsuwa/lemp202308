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
        @vite(['resources/sass/admin/app.scss'])
        @if (strpos(url()->current(), 'login') !== false || strpos(url()->current(), 'register') !== false)
        <!-- URLに'login''register'が含まれる場合のみ(ログイン/新規登録フォーム) -->
            @vite(['resources/sass/admin/auth.scss'])
        @endif

        

        <title>管理者画面 | @yield('title')</title>

    </head>


    <body>

        @if (strpos(url()->current(), 'login') === false && strpos(url()->current(), 'register') === false)
        <!-- URLに'login''register'どちらも含まれない場合のみ -->

            <!--ヘッダー-->
            <header>
                <!-- グローバルナビ -->
                <nav>

                    <div>
                        @include('admin.layouts.menu')
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


</html>