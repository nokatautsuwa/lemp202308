@extends('user.layouts.app')

@section('component')
    @vite(['resources/react/App.tsx', 'resources/react/About.tsx', 'resources/react/Home.tsx', 'resources/react/Test.tsx'])
@endsection

@section('title', 'ホーム')

@section('content')

    <article>

        <section>

            <p>User Home.</p>

        <section>

        <section>

            <!--React: App.tsxで各Routeへ(id='app'内に入れ子で各コンポーネントを入れる)-->
            <!--* URLダイレクトアクセスでは404になるのでLaravel側でRouteを設定する必要あり-->
            <div id='app'>
                <div id='test'></div>
                <div id='home'></div>
                <div id='about'></div>
            </div>

        <section>

    </article>

@endsection
