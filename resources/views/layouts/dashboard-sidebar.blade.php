<nav id="sidebar">
  <div class="p-3 d-flex justify-content-center align-items-center flex-column">
    <img src="{{ Auth::user()->photo }}" width="100" height="100" class="rounded-circle mx-2 bg-secondary mb-3 border">
    <h5>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
    <p class="mb-0">{{ Auth::user()->role->name }}</p>
  </div>
  <ul class="nav nav-pills flex-column mb-auto p-3">
    <li>
      <a href="{{ route('dashboard.index') }}" class="nav-link link-dark w-100 {{ Route::currentRouteName() === 'dashboard.index' ? 'active' : '' }}">
        <i class="fas fa-columns" style="width: 18px;"></i>
        <span class="ms-2">Dashboard</span>
      </a>
    </li>
    @if(Auth::user()->role->slug === 'admin')
    <li>
      <a href="{{ route('user.list', 'users') }}" class="nav-link link-dark w-100 {{ (Route::currentRouteName() === 'user.list' && request()->type === 'users') ? 'active' : '' }}">
        <i class="fas fa-users" style="width: 18px;"></i>
        <span class="ms-2">Users</span>
      </a>
    </li>
    <li>
      <a href="{{ route('user.list', 'staffs') }}" class="nav-link link-dark w-100 {{ (Route::currentRouteName() === 'user.list' && request()->type === 'staffs') ? 'active' : '' }}">
        <i class="fas fa-user-tie" style="width: 18px;"></i>
        <span class="ms-2">Staffs</span>
      </a>
    </li>
    <li>
      <a href="{{ route('user.list', 'admins') }}" class="nav-link link-dark w-100 {{ (Route::currentRouteName() === 'user.list' && request()->type === 'admins') ? 'active' : '' }}">
        <i class="fas fa-users-cog" style="width: 18px;"></i>
        <span class="ms-2">Admins</span>
      </a>
    </li>
    @endif
    @if(Auth::user()->role->slug === 'admin')
    <li>
      <a href="{{ route('faq.list') }}" class="nav-link link-dark w-100 {{ Route::currentRouteName() === 'faq.list' ? 'active' : '' }}">
        <i class="fa fa-question" style="width: 18px;"></i>
        <span class="ms-2">FAQ</span>
      </a>
    </li>
    @endif
    <li>
      <a href="{{ route('profile.index') }}" class="nav-link link-dark w-100 {{ Route::currentRouteName() === 'profile.index' ? 'active' : '' }}">
        <i class="fa fa-user" style="width: 18px;"></i>
        <span class="ms-2">Profile</span>
      </a>
    </li>
    <li class="d-sm-block d-md-none d-lg-none">
      <a href="{{ route('logout') }}" class="nav-link link-dark w-100" onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();">
        <i class="fa-solid fa-right-from-bracket" style="width: 18px;"></i>
        <span class="ms-2">Logout</span>
      </a>
    </li>
  </ul>
  <form id="logout-form-2" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>
</nav>