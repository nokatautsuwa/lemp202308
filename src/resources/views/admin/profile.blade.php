@extends('admin.layouts.app')

@section('component')
    @vite(['resources/sass/admin/profile.scss'])
@endsection

@section('title')
    {{ $admin->name }}
@endsection

@section('content')

    <article>

        <section>

            <ul>
                <li>
                    <img src="{{ asset('storage/images/admin/'.$admin->image) }}" alt="{{ $admin->id }}">
                </li>
                <li>
                    <p className="user-name">{{ $admin->name }}</p>
                </li>
            </ul>

            <div className="date">
                <p>
                    <span>User編集権限</span>
                    <span>{{ $admin->user_authority }}</span>
                </p>
                <p>
                    <span>Admin編集権限</span>
                    <span>{{ $admin->admin_authority }}</span>
                </p>
            </div>

        </section>

    </article>

@endsection
