@extends('admin.app')

@section('title', 'ホーム')

@section('content')

    <div>

        @if(session('success'))
            <!--処理が成功してリダイレクトしたときに表示する-->
            <p class="alert-success">{{ session('success') }}</p>
        @endif

        <p class='title'>サービス利用ユーザー一覧</p>

        <table>

            <!-- 項目タイトル -->
            <tr class='table-title'>
                <th>c</th>
                <th>No.</th>
                <td>ユーザー名</td>
                <td>ステータス</td>
                <td>最終更新</td>
                <td>登録日</td>
            </tr>

            <!-- tableリスト -->
            @foreach ($users as $user)
                <tr>
                    <th>c</th>
                    <th>
                        <a href="{{ route('admin.user.profile', ['account_id' => $user->account_id]) }}">
                            {{ $user->id }}
                        </a>
                    </th>
                    <td>{{ $user->name }}</td>
                    <td>{{ '@' }}{{ $user->account_id }}</td>
                    <td>{{ $user->updated_at->format('Y/m/d H:m') }}</td>
                    <td>{{ $user->created_at->format('Y/m/d') }}</td>
                </tr>
            @endforeach

        </table>

    </div>

@endsection