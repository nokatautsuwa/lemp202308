<!-- views直下のapp.blade.phpはReactコンポーネントを読み込み用 -->
<!-- adminフォルダを作成してapp.blade.phpを別途作成 -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


    <head>

        <!-- metaタグ/linkタグ/CDN -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CDNのreset.css(ress.css)URLを入力-->
        <link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">

        <!-- SCSS読み込み -->
        <!-------------------------------------------->
        @viteReactRefresh
        <!-- ページのベースになるコンポーネント -->
        @vite(['resources/sass/app.scss'])
        <!-- 各ページに合わせたコンポーネントを追加で取得する -->
        @yield('component')
        <!-------------------------------------------->

        

        <title>@yield('title') | 管理者画面</title>

    </head>


    <body>

        @if (Auth::guard('admin')->check())
        <!-- adminでログインしている場合のみ -->

            <header>
                <!-- ヘッダー -->
                <p>
                    <a href="{{ route('admin.home') }}">
                        RESサービス管理画面
                    </a>
                </p>
                <!-- グローバルナビ -->
                <nav>
                    @include('admin.layouts.menu')
                </nav>
            </header>

        @endif

        <!-- メイン -->
        <main>
            @yield('content')
        </main>

    </body>


    <!-- メイン -->
    <!--------------------------->
    @if (Auth::guard('admin')->check())
    <!-- adminでログインしている場合のみ共通で入れる -->
        <script src="{{ asset('js/menu.js') }}"></script>
    @endif
    <!-- ページに合わせて対応するJavaScriptを入れる -->
    @yield('script')
    <!--------------------------->


</html>