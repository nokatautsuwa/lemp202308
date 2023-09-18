<div id='menu'>
  <img src="{{ asset('storage/images/admin/'.Auth::guard('admin')->user()->image) }}" alt="{{ Auth::guard('admin')->user()->id }}">
</div>
<ul id='menu-list' class='menu-list hidden'>
  <li>
    <!-- routeの第2引数に連想配列としてパラメータを渡す -->
    <a href="{{ route('admin.profile', ['id' => Auth::guard('admin')->user()->id]) }}">
      <img src="{{ asset('images/close.svg') }}" alt="profile">
      {{ Auth::guard('admin')->user()->name }}
    </a>
  </li>
  <li class='menu-list-auth-end'>
    <form method="POST" action="{{ route('admin.logout') }}">
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