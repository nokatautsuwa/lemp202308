@extends('user.layouts.app')

@section('title', 'ホーム')

@section('component')
    @vite(['resources/react/User/App.tsx'])
@endsection

@section('content')
    <!-- フロントエンドで実装 --> 
    <div id='app'></div>
@endsection
