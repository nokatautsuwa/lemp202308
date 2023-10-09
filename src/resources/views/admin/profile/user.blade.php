@extends('admin.app')

@section('component')
    @vite(['resources/sass/profile/profile.scss'])

    <!-- * ユーザーページは基本閲覧のみ -->
    <!-- システム管理者であれば他の権限はない状態のためシステム管理者であるかどうかの判定はしない -->

    <!-- 削除機能 -->
    <!---------------------------------------------------------->
    @if (Auth::guard('admin')->user()->user_permission === 1)
    <!-- 自分がユーザー編集権限を持っている -->

        @if ($admins->contains('id', Auth::guard('admin')->user()->id))
        <!-- 担当者に自分が入っている場合に編集可 -->
            @vite(['resources/ts/vanilla/DeleteModalWindow.js'])

            @if($users->deleted_at !== null)
            <!-- 論理削除されている -->
                @vite(['resources/ts/vanilla/EditModalWindow.js'])
            @endif
        @endif

    @endif
    <!---------------------------------------------------------->
@endsection

@section('title')
    {{ $users->name }}
@endsection

@section('content')

<div>

    <aside>

       <!-- プロフィール -->
       <!---------------------------------------------------------->
        <p class='title'>ユーザー管理</p>

        <ul class='account'>
            <li>
                <img src="{{ asset('storage/images/user/'.$users->image) }}" alt="{{ $users->id }}">
            </li>
            <li>
                <p>{{ $users->name }}</p>
                <p class="user-account-id">{{ '@' }}{{ $users->account_id }}</p>
            </li>
        </ul>

        @if ($users->deleted_at !== null)
        <!-- 論理削除されている管理者を判別できるようにする -->
            <p class='help-block'>* このユーザーは削除されています</p>
        @endif

        <ul class="place">

            <li>
                <p>
                    <span>ステータス</span>
                    <span>{{ $users->status }}</span>
                </p>
            </li>
            <li>
                <p>
                    <span>登録日</span>
                    <span>{{ $users->created_at->format('Y/m/d') }}</span>
                </p>
            </li>
            
        </ul>
       <!---------------------------------------------------------->


        <!-- 削除機能 -->
       <!---------------------------------------------------------->
        @if (Auth::guard('admin')->user()->user_permission === 1)
        <!-- 自分がユーザー編集権限を持っている -->

            @if ($admins->contains('id', Auth::guard('admin')->user()->id))
            <!-- 担当者に自分が入っている場合に編集可 -->

                <ul class="request">

                    @if($users->deleted_at !== null)
                    <!-- 論理削除されている -->
                        <li id='edit'>
                            <p>復旧</p>
                        </li>
                        <!-- 復旧モーダルウィンドウ -->
                        @include('admin.layouts.user_edit_modal')
                    @endif

                    <li id='delete'>
                        <p>削除</p>
                    </li>
                    <!-- 削除モーダルウィンドウ -->
                    @include('admin.layouts.user_delete_modal')

                </ul>

            @endif

        @endif
       <!---------------------------------------------------------->     


        @if(session('success'))
            <!--処理が成功してリダイレクトしたときに表示する-->
            <p class="alert-success">{{ session('success') }}</p>
        @endif         

    </aside>


    <!-- ダッシュボード -->
    <!---------------------------------------------------------->
    <div class='dashboard'>

        <ul>

            <p class='title'>担当者</p>

            <table>

                <!-- 項目タイトル -->
                <tr class='table-title'>
                    <th>⚫︎</th>
                    <th>No.</th>
                    <td>管理者名</td>
                    <td>所属会社</td>
                    <td>最終更新</td>
                    <td>登録日</td>
                </tr>

                <!-- tableリスト -->
                <!-- Controllerでアサインを5人以上にできないようにする -->
                @foreach ($admins as $admin)
                    <tr>
                        <th>
                            @if ($admin->id === Auth::guard('admin')->user()->id)
                            <!-- ログイン管理者を判別できるようにする -->
                                ⚫︎
                            @elseif ($admin->deleted_at !== null)
                            <!-- 論理削除されている管理者を判別できるようにする -->
                                x
                            @endif
                        </th>
                        <th>
                            <a href="{{ route('admin.profile', ['id' => $admin->id]) }}">
                                {{ $admin->id }}
                            </a>
                        </th>
                        <td>
                            {{ $admin->name }}
                            @if ($admin->admin_permission === 1)
                            <!-- 管理者編集権限有(上長)を判別できるようにする -->
                                ⚫︎
                            @endif
                        </td>
                        <td>{{ $admin->place }}</td>
                        <td>{{ $admin->updated_at->format('Y/m/d H:i') }}</td>
                        <td>{{ $admin->created_at->format('Y/m/d') }}</td>
                    </tr>
                @endforeach

            </table>

        </ul>


        <!-- 履歴 -->
        <!---------------------------------------------------------->
        <ul class='history'>

            <p class='title'>更新履歴</p>

            @foreach ($user_histories as $history)

                <li>
                    <div>
                        <img src="{{ asset('images/'. $user_histories_type_icon[$history->type]) }}" alt="{{ $history->type }}">
                        <p>{{ $history->created_at->format('Y/m/d H:i') }}</p>
                        <p>{{ $user_histories_type_message[$history->type] }}</p>
                    </div>
                </li>

            @endforeach

        </ul>
        <!---------------------------------------------------------->

    </div>
    <!---------------------------------------------------------->

</div>

@endsection
