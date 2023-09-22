<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


    <head>

        <!-- metaタグ/linkタグ/CDN -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CDNのreset.css(ress.css)URLを入力-->
        <link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">

        <!-- React/SCSSコンポーネントSCSS読み込み -->
        <!-------------------------------------------->
        @viteReactRefresh
        <!-- ページのベースになるコンポーネント -->
        @vite(['resources/sass/user/app.scss'])
        <!-- 各ページに合わせたコンポーネントを追加で取得する -->
        @yield('component')
        <!-------------------------------------------->

        <title>RES | @yield('title')</title>

    </head>


    <body>

        @if (strpos(url()->current(), 'login') === false && strpos(url()->current(), 'register') === false)
        <!-- URLに'login''register'どちらも含まれない場合のみ -->

            <header>
                <!-- ヘッダー -->


                <!-- グローバルナビ -->
                <nav>
                    @include('user.layouts.menu')
                </nav>
            </header>

        @endif
        
        <!-- サイドバー -->
        <aside></aside>

        <!-- メイン -->
        <main>
            @yield('content')
        </main>

    </body>

    
    @if (Auth::guard('user')->check())
    <!-- userでログインしている場合のみ -->
        <script src="{{ asset('js/menu.js') }}"></script>
    @endif


    <!-- フッター -->
    <footer>
        chat service RES All rights reserved.
    </footer>


</html>
