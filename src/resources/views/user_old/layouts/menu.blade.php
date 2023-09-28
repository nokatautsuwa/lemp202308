@if (Auth::guard('user')->check())

    <!-- usersテーブルでログインしている場合 -->
    <!------------------------------------------------>
    <div id='menu'>
        <img src="{{ asset('storage/images/user/'.Auth::guard('user')->user()->image) }}" alt="{{ Auth::guard('user')->user()->account_id }}">
    </div>
    <ul id='menu-list' class='menu-list hidden'>
        <li>
            <!-- routeの第2引数に連想配列としてパラメータを渡す -->
            <a href="{{ route('profile', ['account_id' => Auth::guard('user')->user()->account_id]) }}">
                <img src="{{ asset('images/close.svg') }}" alt="profile">
                {{ Auth::guard('user')->user()->name }}
            </a>
        </li>
        <li>
            <a href="{{ route('profile.settings', ['account_id' => Auth::guard('user')->user()->account_id]) }}">
                <img src="{{ asset('images/close.svg') }}" alt="settings">
                設定
            </a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" onclick="return confirm('ログアウトします。よろしいですか？');">
                    <img src="{{ asset('images/close.svg') }}" alt="logout">
                    ログアウト
                </button>
            </form>
        </li>
    </ul>
    <!------------------------------------------------>

@else

    <!-- usersテーブルでログインしていない場合 -->
    <!------------------------------------------------>
    <div id='menu'>
        <a href="{{ route('login') }}">
            <img src="{{ asset('storage/images/user/icon_default.svg') }}" alt="entrance">
        </a>
    </div>
    <!------------------------------------------------>

@endif