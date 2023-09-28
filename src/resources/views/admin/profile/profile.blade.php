@extends('admin.app')

@section('component')
    @vite(['resources/sass/profile/profile.scss'])
@endsection

@section('title')
    {{ $admin->name }}
@endsection

@section('content')

    <article>

        <section class='left'>

            @if ($admin->system_permission === 1)
            <!-- システム管理者 -->

                <p class='title'>システム管理者</p>

                <ul class='account'>
                    <li>
                        <img src="{{ asset('storage/images/admin/'.$admin->image) }}" alt="{{ $admin->id }}">
                    </li>
                    <li>
                        <p>
                            {{ $admin->name }}⚫︎
                        </p>
                    </li>
                </ul>

            @else

                <p class='title'>管理者アカウントページ</p>

                <ul class='account'>
                    <li>
                        <img src="{{ asset('storage/images/admin/'.$admin->image) }}" alt="{{ $admin->id }}">
                    </li>
                    <li>
                        <p>
                            {{ $admin->name }}
                        </p>
                    </li>
                </ul>

                <ul class="place">

                    <li>
                        <p>
                            <span>所属</span>
                            <span>
                                サンプル
                                @if ($admin->admin_permission === 1)
                                <!-- 管理者編集権限有(リーダー)を判別できるようにする -->
                                    ⚫︎
                                @endif
                            </span>
                        </p>
                    </li>
                    <li>
                        <p>
                            <span>配属日</span>
                            <span>{{ $admin->updated_at->format('Y/m/d') }}</span>
                        </p>
                        <p>
                            <span>管理者登録日</span>
                            <span>{{ $admin->created_at->format('Y/m/d') }}</span>
                        </p>
                    </li>
                </ul>

            @endif

            @if ($admin->id === Auth::guard('admin')->user()->id)
            <!-- 自分のアカウントページのみ表示 -->

                <ul class="request">
                    <li>
                        <p>
                            <a href="{{ route('admin.request') }}">
                                各種手続き
                            </a>
                        </p>
                    </li>
                </ul>

            @endif

        </section>


        <section class='right'>

            <p>
                <span>担当ユーザー一覧</span>
            </p>
            <p>
                <span>利用ユーザー編集権限</span>
                <span>{{ $admin->user_permission }}</span>
            </p>
            <p>
                <span>管理者編集権限</span>
                <span>{{ $admin->admin_permission }}</span>
            </p>
            <p>
                <span>システム管理者権限</span>
                <span>{{ $admin->system_permission }}</span>
            </p>

        </section>

    </article>

@endsection

@section('script')
    
@endsection
