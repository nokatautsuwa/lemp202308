@extends('admin.app')

@section('title', 'ホーム')

@section('content')

    <div>

        @if(session('success'))
            <!--処理が成功してリダイレクトしたときに表示する-->
            <p class="alert-success">{{ session('success') }}</p>
        @endif

        <p class='title'>サービス利用ユーザー一覧</p>

        <p class="alert-success">* xは現在論理削除されているアカウントです</p>

        <table>

            <!-- 項目タイトル -->
            <tr class='table-title'>
                <th>⚫︎</th>
                <th>No.</th>
                <td>ユーザー名</td>
                <td>ステータス</td>
                <td>最終更新</td>
                <td>登録日</td>
            </tr>

            <!-- tableリスト -->
            @foreach ($users as $user)
                <tr>
                    <th>
                        @if ($user->deleted_at !== null)
                        <!-- 論理削除されているユーザーを判別できるようにする -->
                            x
                        @endif
                    </th>
                    <th>
                        <a href="{{ route('admin.user', ['account_id' => $user->account_id]) }}">
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