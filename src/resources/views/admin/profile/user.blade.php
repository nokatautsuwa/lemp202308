@extends('admin.app')

@section('component')
    @vite(['resources/sass/profile/profile.scss'])
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

        <ul class="place">

            <li>
                <p>
                    <span>ステータス</span>
                    <span>sample</span>
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


        <!-- 編集 -->
       <!---------------------------------------------------------->
        <ul class="request">
            @if ($admins->contains('id', Auth::guard('admin')->user()->id) && Auth::guard('admin')->user()->system_permission !== 1)
            <!-- 担当者に自分が入っている -->
            <!-- 自分がシステム管理者でない -->

                @if (Auth::guard('admin')->user()->user_permission === 1)
                <!-- 自分にユーザー編集権限がついている(1/*/*) -->
                    <li>
                        <p>
                            <a href="{{ route('admin.request') }}">
                                編集
                            </a>
                        </p>
                    </li>
                @else
                <!-- 自分にユーザー編集権限がついていない(0/*/*) -->
                    <li>
                        <p class='help-block'>* ユーザー編集権限がありません。編集する際は申請をお願いいたします。</p>
                        <p>
                            <a href="{{ route('admin.request') }}">
                                各種申請
                            </a>
                        </p>
                    </li>
                @endif

            @endif
        </ul>              
       <!---------------------------------------------------------->            

    </aside>


    <!-- ダッシュボード -->
    <!---------------------------------------------------------->
    <div class='dashboard'>

        <ul>

            <p class='title'>アサイン</p>

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
                        <td>{{ $admin->updated_at->format('Y/m/d H:m') }}</td>
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
                        <p>{{ $history->created_at->format('Y/m/d H:m') }}</p>
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
