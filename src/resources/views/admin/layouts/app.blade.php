<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<head>

     <!-- metaタグ/linkタグ/CDN -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CDNのreset.css(ress.css)URLを入力-->
    <link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">

    <!-- Reactコンポーネント/SCSS読み込み/タイトル -->

    

    <title>管理者画面 | @yield('title')</title>

</head>


<body>

    <!--ヘッダー-->
    <header>

    </header>

    <!--メイン-->
    <main>
        @yield('content')
    </main>

</body>


<!--フッター-->
<footer>
    footer
</footer>

</html>