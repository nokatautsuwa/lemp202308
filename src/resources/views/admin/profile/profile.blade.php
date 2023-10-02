@extends('admin.app')

@section('component')
    @vite(['resources/sass/profile/profile.scss'])
@endsection

@section('title')
    {{ $admins->name }}
@endsection

@section('content')

<div>

    <aside>

       <!-- プロフィール -->
       <!---------------------------------------------------------->
        @if ($admins->system_permission === 1)
        <!-- システム管理者 -->

            <p class='title'>システム管理者</p>

            <ul class='account'>
                <li>
                    <img src="{{ asset('storage/images/admin/'.$admins->image) }}" alt="{{ $admins->id }}">
                </li>
                <li>
                    <p>
                        {{ $admins->name }}
                    </p>
                </li>
            </ul>

        @else
        <!-- システム管理者以外 -->

            <p class='title'>管理者</p>

            <ul class='account'>
                <li>
                    <img src="{{ asset('storage/images/admin/'.$admins->image) }}" alt="{{ $admins->id }}">
                </li>
                <li>
                    <p>
                        {{ $admins->name }}
                        @if ($admins->admin_permission === 1)
                        <!-- 管理者編集権限有(上長)を判別できるようにする -->
                            ⚫︎
                        @endif
                    </p>
                </li>
            </ul>

            <ul class="place">

                <li>
                    <p>
                        <span>所属会社</span>
                        <span>
                            {{ $admins->place }}
                        </span>
                    </p>
                    <p>
                        <span>担当エリア</span>
                        <span>{{ $admins->area }}</span>
                    </p>
                </li>
                <li>
                    <p>
                        <span>配属日</span>
                        <span>{{ $admins->updated_at->format('Y/m/d') }}</span>
                    </p>
                    <p>
                        <span>管理者登録日</span>
                        <span>{{ $admins->created_at->format('Y/m/d') }}</span>
                    </p>
                </li>

            </ul>

        @endif
       <!---------------------------------------------------------->


        <!-- 編集/申請 -->
        <!---------------------------------------------------------->
        <ul class="request">

            @if ($admins->id === Auth::guard('admin')->user()->id || (Auth::guard('admin')->user()->system_permission === 1 && $admins->system_permission !== 1) || (Auth::guard('admin')->user()->admins_permission === 1 && $admins->place === Auth::guard('admin')->user()->place))
            <!-- 編集可能条件 -->
            <!-- 1. 自分のアカウント -->
            <!-- 2. 自分がシステム管理者(0/0/1): システム管理者以外の全アカウント -->
            <!-- 3. 自分に管理者編集権限がついている(*/1/0): 同じ所属会社のアカウントのみ -->
                <li>
                    <p>
                        <a href="{{ route('admin.request') }}">
                            編集
                        </a>
                    </p>
                </li>
            @endif

            @if ($admins->id === Auth::guard('admin')->user()->id)
            <!-- 自分のアカウントページのみ表示 -->
                <li>
                    <p>
                        <a href="{{ route('admin.request') }}">
                            各種手続き
                        </a>
                    </p>
                </li>
            @endif

        </ul>              
       <!---------------------------------------------------------->            

    </aside>


    <!-- ダッシュボード -->
    <!---------------------------------------------------------->
    <div class='dashboard'>

        @if ($admins->system_permission === 1)
        <!-- システム管理者: 全管理者の一覧を表示する -->

            @if (Auth::guard('admin')->user()->id === $admins->id)
            <!-- 自分のシステム管理者ページのみ -->

                <ul>

                    <p class='title'>管理者一覧</p>

                    <table>

                        <!-- 項目タイトル -->
                        <tr class='table-title'>
                            <th>No.</th>
                            <td>所属会社</td>
                            <td>エリア</td>
                            <td>管理者名</td>
                            <td>最終更新</td>
                        </tr>

                        <!-- tableリスト -->
                        @foreach ($admin_except_system as $excpet_system)
                            <tr>
                                <th>
                                    <a href="{{ route('admin.profile', ['id' => $excpet_system->id]) }}">
                                        {{ $excpet_system->id }}
                                    </a>
                                </th>
                                <td>{{ $excpet_system->place }}</td>
                                <td>{{ $excpet_system->area }}</td>
                                <td>
                                    {{ $excpet_system->name }}
                                    @if ($excpet_system->admin_permission === 1)
                                    <!-- 管理者編集権限有(上長)を判別できるようにする -->
                                        ⚫︎
                                    @endif
                                </td>
                                <td>{{ $excpet_system->updated_at->format('Y/m/d H:m') }}</td>
                            </tr>
                        @endforeach

                    </table>

                </ul>

            @endif

        @else
        <!-- システム管理者以外: 担当ユーザーと同じ所属会社の管理者の一覧を表示する -->

            <ul>

                <p class='title'>担当ユーザー一覧</p>

                <table>

                    <!-- 項目タイトル -->
                    <tr class='table-title'>
                        <th>No.</th>
                        <td>アカウント名</td>
                        <td>アカウントID</td>
                        <td>ステータス</td>
                        <td>登録日</td>
                    </tr>

                    <!-- tableリスト -->
                    @foreach ($users as $user)
                        <tr>
                            <th>
                                <a href="{{ route('admin.user.profile', ['account_id' => $user->account_id]) }}">
                                    {{ $user->id }}
                                </a>
                            </th>
                            <td>{{ $user->name }}</td>
                            <td>{{ '@' }}{{ $user->account_id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->created_at->format('Y/m/d') }}</td>
                        </tr>
                    @endforeach

                </table>

            </ul>

            <ul>

                <p class='title'>{{ $admins->place }}所属メンバー一覧</p>

                <table>

                    <!-- 項目タイトル -->
                    <tr class='table-title'>
                        <th>⚫︎</th>
                        <th>No.</th>
                        <td>管理者名</td>
                        <td>エリア</td>
                        <td>最終更新</td>
                        <td>登録日</td>
                    </tr>

                    <!-- tableリスト -->
                    @foreach ($admin_place as $member)
                        <tr>
                            <th>
                                @if ($member->id === Auth::guard('admin')->user()->id)
                                <!-- ログイン管理者を判別できるようにする -->
                                    ⚫︎
                                @endif
                            </th>
                            <th>
                                <a href="{{ route('admin.profile', ['id' => $member->id]) }}">
                                    {{ $member->id }}
                                </a>
                            </th>
                            <td>
                                {{ $member->name }}
                                @if ($member->admin_permission === 1)
                                <!-- 管理者編集権限有(上長)を判別できるようにする -->
                                    ⚫︎
                                @endif
                            </td>
                            <td>{{ $member->area }}</td>
                            <td>{{ $member->updated_at->format('Y/m/d H:m') }}</td>
                            <td>{{ $member->created_at->format('Y/m/d') }}</td>
                        </tr>
                    @endforeach

                </table>

            </ul>

        @endif

        <ul>

            <p class='title'>システム管理者一覧</p>

            <table>

                <!-- 項目タイトル -->
                <tr class='table-title'>
                    <th>⚫︎</th>
                    <th>No.</th>
                    <td>管理者名</td>
                    <td>所属会社</td>
                    <td>エリア</td>
                    <td>最終更新</td>
                </tr>

                <!-- tableリスト -->
                @foreach ($admin_system as $system)
                    <tr>
                        <th>
                            @if ($system->id === Auth::guard('admin')->user()->id)
                            <!-- ログイン管理者を判別できるようにする -->
                                ⚫︎
                            @endif
                        </th>
                        <th>
                            <a href="{{ route('admin.profile', ['id' => $system->id]) }}">
                                {{ $system->id }}
                            </a>
                        </th>
                        <td>{{ $system->name }}</td>
                        <td>{{ $system->place }}</td>
                        <td>{{ $system->area }}</td>
                        <td>{{ $system->updated_at->format('Y/m/d H:m') }}</td>
                    </tr>
                @endforeach

            </table>

        </ul>


        <!-- 履歴 -->
        <!---------------------------------------------------------->
        <ul class='history'>

            <p class='title'>更新履歴</p>

            @foreach ($admin_histories as $history)

                <li>
                    <div>
                        <img src="{{ asset('images/'. $admin_histories_type_icon[$history->type]) }}" alt="{{ $history->type }}">
                        <p>{{ $history->created_at->format('Y/m/d H:m') }}</p>
                    </div>
                    <p>{{ $admin_histories_type_message[$history->type] }}</p>
                </li>

            @endforeach

        </ul>
        <!---------------------------------------------------------->

    </div>
    <!---------------------------------------------------------->

</div>

@endsection
