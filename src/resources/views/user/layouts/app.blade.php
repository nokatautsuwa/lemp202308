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

        <title>@yield('title') | RES</title>

    </head>


    <body>
        <!-- ヘッダー -->
        <header>
          Header
        </header>

        <!-- ページ表示 -->
        @yield('content')

    </body>


</html>
