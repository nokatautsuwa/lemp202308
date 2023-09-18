@if (Auth::guard('user')->check())
<!-- usersテーブルでログインしている場合 -->
<!------------------------------------------------>
<div id='menu'>
  <img src="{{ asset('storage/images/user/'.Auth::guard('user')->user()->image) }}" alt="{{ Auth::guard('user')->user()->account_id }}">
</div>
<ul id='menu-list' class='menu-list hidden'>
  <li>
    <!-- routeの第2引数に連想配列としてパラメータを渡す -->
    <a href="{{ route('user.profile', ['account_id' => Auth::guard('user')->user()->account_id]) }}">
      <img src="{{ asset('images/close.svg') }}" alt="profile">
      {{ Auth::guard('user')->user()->name }}
    </a>
  </li>
  <li>
    <a href="{{ route('user.settings', ['account_id' => Auth::guard('user')->user()->account_id]) }}">
      <img src="{{ asset('images/close.svg') }}" alt="settings">
      設定
    </a>
  </li>
  <li class='menu-list-auth-end'>
    <form method="POST" action="{{ route('user.logout') }}">
      @csrf
      <button type="submit">
        <img src="{{ asset('images/close.svg') }}" alt="logout">
        ログアウト
      </button>
    </form>
  </li>
  <li class='menu-list-entrance'>
    <a href="{{ route('home') }}">
      <img src="{{ asset('images/close.svg') }}" alt="entrance">
      エントランス
    </a>
  </li>
</ul>
<!------------------------------------------------>
@else
<!-- usersテーブルでログインしていない場合 -->
<!------------------------------------------------>
<div id='menu'>
  <img src="{{ asset('storage/images/user/icon_default.svg') }}" alt="entrance">
</div>
<ul id='menu-list' class='menu-list hidden'>
  <li>
    <a href="{{ route('user.login') }}">
      <img src="{{ asset('images/close.svg') }}" alt="login">
      ログイン
    </a>
  </li>
  <li>
    <a href="{{ route('home') }}">
      <img src="{{ asset('images/close.svg') }}" alt="entrance">
      エントランス
    </a>
  </li>
</ul>
<!------------------------------------------------>
@endif