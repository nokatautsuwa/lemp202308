@extends('admin.app')

@section('component')
    @vite(['resources/sass/profile/profile.scss'])

    <!-- 編集機能 -->
    <!---------------------------------------------------------->
    @if ($admins->id === Auth::guard('admin')->user()->id)
    <!-- 自分のアカウント -->

        @if($admins->deleted_at === null)
            @vite(['resources/ts/vanilla/EditModalWindow.js', 'resources/ts/vanilla/ImagePreview.js'])
        @endif

    @else
    <!-- 自分のアカウントでない -->

        @if(Auth::guard('admin')->user()->system_permission === 1)
        <!-- 自分がシステム管理者 -->

            @vite(['resources/ts/vanilla/EditModalWindow.js'])

            @if($admins->deleted_at === null)
            <!-- 論理削除されていない -->
                @vite(['resources/ts/vanilla/ImagePreview.js'])
            @endif

        @else
        <!-- 自分がシステム管理者でない -->

            @if (Auth::guard('admin')->user()->admin_permission === 1)
            <!-- 自分が管理者編集権限を持っている -->

                @if($admins->system_permission !== 1 && $admins->place === Auth::guard('admin')->user()->place && $admins->deleted_at === null)
                <!-- システム管理者でない&自分と同じ所属会社の管理者 -->
                    @vite(['resources/ts/vanilla/EditModalWindow.js'])
                    
                    @if($admins->deleted_at === null)
                    <!-- 論理削除されていない -->
                        @vite(['resources/ts/vanilla/ImagePreview.js'])
                    @endif

                @endif

            @endif

        @endif

    @endif
    <!---------------------------------------------------------->

    <!-- 削除機能(レコード削除はシステム管理者のみ) -->
    <!---------------------------------------------------------->
    @if (Auth::guard('admin')->user()->system_permission === 1)
    <!-- 自分がシステム管理者 -->

        @if($admins->id === Auth::guard('admin')->user()->id || $admins->system_permission !== 1)
        <!-- 自分のアカウントまたはシステム管理者でない全管理者に対して削除可 -->
            @vite(['resources/ts/vanilla/DeleteModalWindow.js'])
        @endif

    @else
    <!-- 自分がシステム管理者でない -->

        @if($admins->deleted_at === null)
        <!-- 論理削除されていない -->

            @if(Auth::guard('admin')->user()->admin_permission === 1)
            <!-- 自分が管理者編集権限を持っている -->

                @if($admins->system_permission !== 1 && $admins->place === Auth::guard('admin')->user()->place)
                <!-- システム管理者でない&自分と同じ所属会社の管理者に対して可 -->
                    @vite(['resources/ts/vanilla/DeleteModalWindow.js'])
                @endif

            @endif

        @endif

    @endif
    <!---------------------------------------------------------->

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

            @if ($admins->deleted_at !== null)
            <!-- 論理削除されている管理者を判別できるようにする -->
                <p class='help-block'>* この管理者は削除されています</p>
            @endif

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


        <ul class="request"> 

            <!-- 編集機能(条件はviteと同じ) -->
            <!---------------------------------------------------------->
            @if ($admins->id === Auth::guard('admin')->user()->id)
            <!-- 自分のアカウント -->
                    <li id='edit'>
                        <p>編集</p>
                    </li>
                    <!-- 編集モーダルウィンドウ -->
                    @include('admin.layouts.admin_edit_modal')
                    <li>
                        <p>
                            <a href="{{ route('admin.request') }}">
                                各種申請
                            </a>
                        </p>
                    </li>

            @else
            <!-- 自分のアカウントでない -->

                @if(Auth::guard('admin')->user()->system_permission === 1)
                <!-- 自分がシステム管理者 -->

                    <li id='edit'>
                        <p>編集</p>
                    </li>
                    <!-- 編集モーダルウィンドウ -->
                    @include('admin.layouts.admin_edit_modal')

                @else
                <!-- 自分がシステム管理者でない -->

                    @if (Auth::guard('admin')->user()->admin_permission === 1)
                    <!-- 自分が管理者編集権限を持っている -->

                        @if($admins->system_permission !== 1 && $admins->place === Auth::guard('admin')->user()->place && $admins->deleted_at === null)
                        <!-- システム管理者でない&自分と同じ所属会社&論理削除されていない管理者に対して編集可 -->

                            <li id='edit'>
                                <p>編集</p>
                            </li>
                            <!-- 編集モーダルウィンドウ -->
                            @include('admin.layouts.admin_edit_modal')

                        @endif

                    @endif

                @endif

            @endif
            <!---------------------------------------------------------->

            <!-- 削除機能(条件はviteと同じ) -->
            <!---------------------------------------------------------->
            @if (Auth::guard('admin')->user()->system_permission === 1)
            <!-- 自分がシステム管理者 -->

                @if($admins->id === Auth::guard('admin')->user()->id || $admins->system_permission !== 1)
                <!-- 自分のアカウントまたはシステム管理者でない全管理者 -->

                    <li id='delete'>
                        <p>管理者削除</p>
                    </li>
                    <!-- 削除モーダルウィンドウ -->
                    @include('admin.layouts.admin_delete_modal')

                @endif

            @else
            <!-- 自分がシステム管理者でない -->

                @if($admins->deleted_at === null)
                <!-- 論理削除されていない -->

                    @if(Auth::guard('admin')->user()->admin_permission === 1)
                    <!-- 自分が管理者編集権限を持っている -->

                        @if($admins->system_permission !== 1 && $admins->place === Auth::guard('admin')->user()->place)
                        <!-- システム管理者でない&自分と同じ所属会社の管理者に対して可 -->

                            <li id='delete'>
                                <p>管理者削除</p>
                            </li>
                            <!-- 削除モーダルウィンドウ -->
                            @include('admin.layouts.admin_delete_modal')

                        @endif

                    @endif

                @endif

            @endif
            <!---------------------------------------------------------->

        </ul>


        @if(session('success'))
            <!--処理が成功してリダイレクトしたときに表示する-->
            <p class="alert-success">{{ session('success') }}</p>
        @endif         

    </aside>


    <!-- ダッシュボード -->
    <!---------------------------------------------------------->
    <div class='dashboard'>

        <p class="alert-success">* ⚫︎は現在ログイン中のアカウントです</p>
        <p class="alert-success">* xは現在論理削除されているアカウントです</p>
        <p class="alert-success">* 名前の⚫︎は管理者編集権限のある管理者です</p>

        @if ($admins->system_permission === 1)
        <!-- システム管理者: 全管理者の一覧を表示する -->

            @if (Auth::guard('admin')->user()->id === $admins->id)
            <!-- 自分のシステム管理者ページのみ -->

                <ul>

                    <p class='title'>管理者一覧</p>

                    <table>

                        <!-- 項目タイトル -->
                        <tr class='table-title'>
                            <th>⚫︎</th>
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
                                    @if ($excpet_system->deleted_at !== null)
                                    <!-- 論理削除されている管理者を判別できるようにする -->
                                        x
                                    @endif
                                </th>
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
                                <td>{{ $excpet_system->updated_at->format('Y/m/d H:i') }}</td>
                            </tr>
                        @endforeach

                    </table>

                </ul>

            @endif

        @else
        <!-- システム管理者以外: 担当ユーザー/同じ配属チームの管理者の一覧を表示する -->

            <ul>

                <p class='title'>担当ユーザー一覧</p>

                <table>

                    <!-- 項目タイトル -->
                    <tr class='table-title'>
                        <th>⚫︎</th>
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
                                @elseif ($member->deleted_at !== null)
                                <!-- 論理削除されている管理者を判別できるようにする -->
                                    x
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
                            <td>{{ $member->updated_at->format('Y/m/d H:i') }}</td>
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
                            @elseif ($system->deleted_at !== null)
                            <!-- 論理削除されている管理者を判別できるようにする -->
                                x
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
                        <td>{{ $system->updated_at->format('Y/m/d H:i') }}</td>
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
                        <p>{{ $history->created_at->format('Y/m/d H:i') }}</p>
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
