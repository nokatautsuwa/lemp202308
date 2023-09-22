@extends('admin.layouts.app')

@section('component')
    @vite(['resources/sass/admin/profile.scss'])
@endsection

@section('title')
    {{ $admin->name }}
@endsection

@section('content')

    <article>

        <section class='left'>

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
                        <span>配属先</span>
                        <span>サンプル</span>
                    </p>
                </li>
                <li>
                    <p>
                        <span>配属日</span>
                        <span>{{ $admin->updated_at->format('Y/m/d') }}</span>
                    </p>
                    <p>
                        <span>登録日</span>
                        <span>{{ $admin->created_at->format('Y/m/d') }}</span>
                    </p>
                </li>
            </ul>

            <ul class="request">
                <li>
                    <p>
                        <a href="{{ route('admin.profile.request', ['id' => Auth::guard('admin')->user()->id]) }}">
                            各種申請
                        </a>
                    </p>
                </li>
            </ul>

        </section>

        <section class='right'>

            <p>
                <span>User編集権限</span>
                <span>{{ $admin->user_authority }}</span>
            </p>
            <p>
                <span>Admin編集権限</span>
                <span>{{ $admin->admin_authority }}</span>
            </p>

        </section>

    </article>

@endsection
