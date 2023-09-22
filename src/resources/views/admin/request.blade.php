@extends('admin.layouts.app')

@section('component')
    @vite(['resources/sass/admin/request.scss'])
@endsection

@section('title')
    {{ $admin->name }}
@endsection

@section('content')

    <article>

        <section>

            <p class='title'>サービス利用ユーザー一覧</p>

        <section>

        <section>

            <ul>
                <li>
                    <img src="{{ asset('storage/images/admin/'.$admin->image) }}" alt="{{ $admin->id }}">
                </li>
                <li>
                    <p>
                        {{ $admin->name }}
                    </p>
                </li>
            </ul>

            <ul>
                <li>
                    <p>
                        <a href="{{ route('admin.profile', ['id' => Auth::guard('admin')->user()->id]) }}">
                            キャンセル
                        </a>
                    </p>
                    <!-- ページを離れるときに確認メッセージを表示させる -->
                    <script src="{{ asset('js/beforeunload.js') }}"></script>
                </li>
            </ul>

        </section>

    </article>

@endsection