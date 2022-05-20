<nav id="sidebar">
  <ul class="nav nav-pills flex-column mb-auto p-3">
    <li>
      <a href="{{ route('dashboard.index') }}" class="nav-link link-dark {{ Route::currentRouteName() === 'dashboard.index' ? 'active' : '' }}">
        <i class="fas fa-columns"></i>
        <span class="ms-2">Dashboard</span>
      </a>
    </li>
    @if(Auth::user()->role->slug === 'admin')
    <li>
      <a href="{{ route('user.list', 'users') }}" class="nav-link link-dark {{ (Route::currentRouteName() === 'user.list' && request()->type === 'users') ? 'active' : '' }}">
        <i class="fas fa-user"></i>
        <span class="ms-2">Users</span>
      </a>
    </li>
    <li>
      <a href="{{ route('user.list', 'staffs') }}" class="nav-link link-dark {{ (Route::currentRouteName() === 'user.list' && request()->type === 'staffs') ? 'active' : '' }}">
        <i class="fas fa-user"></i>
        <span class="ms-2">Staffs</span>
      </a>
    </li>
    <li>
      <a href="{{ route('user.list', 'admins') }}" class="nav-link link-dark {{ (Route::currentRouteName() === 'user.list' && request()->type === 'admins') ? 'active' : '' }}">
        <i class="fas fa-user"></i>
        <span class="ms-2">Admins</span>
      </a>
    </li>
    @endif
    @if(Auth::user()->role->slug === 'admin')
    <li>
      <a href="{{ route('faq.list') }}" class="nav-link link-dark {{ Route::currentRouteName() === 'faq.list' ? 'active' : '' }}">
        <i class="fa fa-question"></i>
        <span class="ms-2">FAQ</span>
      </a>
    </li>
    @endif
    <li>
      <a href="{{ route('profile.index') }}" class="nav-link link-dark {{ Route::currentRouteName() === 'profile.index' ? 'active' : '' }}">
        <i class="fa fa-user"></i>
        <span class="ms-2">Profile</span>
      </a>
    </li>
  </ul>
  <hr>
</nav>