@extends('admin.app')

@section('component')
    @vite(['resources/sass/profile/profile.scss', 'resources/ts/vanilla/beforeunload.js'])
@endsection

@section('title')
    {{ $admin->name }}
@endsection

@section('content')

    <div>

        <aside>

            <p class='title'>各種申請画面</p>

            <ul class='account'>

                <li>
                    <img src="{{ asset('storage/images/admin/'.$admin->image) }}" alt="{{ $admin->id }}">
                </li>
                <li>
                    <p>{{ $admin->name }}⚫︎</p>
                </li>

            </ul>

            <ul class="request">
                <li>
                    <p>
                        <a href="{{ route('admin.profile', ['id' => Auth::guard('admin')->user()->id]) }}">
                            キャンセル
                        </a>
                    </p>
                </li>
            </ul>    

        </aside>


        <div class='dashboard'>
    
            <ul>

                <p class='title'>申請内容</p>

                <li>
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
                </li>
                <li>
                    <p>
                        <a href="{{ route('admin.profile', ['id' => Auth::guard('admin')->user()->id]) }}">
                            送信
                        </a>
                    </p>
                </li>

            </ul>

        </div>

    </div>

@endsection