@extends('admin.app')

@section('title', 'ホーム')

@section('content')

    @if(session('success'))

        <!--処理が成功してリダイレクトしたときに表示する-->
        <p class="alert-success">
            {{ session('success') }}
        </p>

    @endif

        <article>

            <section>

                <p class='title'>サービス利用ユーザー一覧</p>

                <table>

                    <!-- 項目タイトル -->
                    <tr class='table-title'>
                        <th>c</th>
                        <th>No.</th>
                        <td>ユーザー名</td>
                        <td>ユーザーID</td>
                        <td>ステータス</td>
                        <td>担当者</td>
                    </tr>

                    <!-- tableリスト -->
                    @foreach ($users as $user)
                        <tr>
                            <th>c</th>
                            <th>{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ '@' }}{{ $user->account_id }}</td>
                            <td>{{ '@' }}{{ $user->account_id }}</td>
                            <td>{{ '@' }}{{ $user->account_id }}</td>
                        </tr>
                    @endforeach

                </table>

            <section>

        </article>

    @endsection

@section('script')
    
@endsection