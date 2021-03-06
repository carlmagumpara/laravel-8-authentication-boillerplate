<nav id="navbar-example2" class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top custom-nav">
  <div class="{{ !$dashboard ? 'container' : 'container-fluid' }}">
    @if($dashboard)
    <div class="custom-menu me-3 d-sm-block d-md-none d-lg-none">
      <button type="button" id="sidebarCollapse" class="btn btn-link text-decoration-none">
        <i class="fa fa-bars"></i>{{'  '}}Menu
      </button>
    </div>
    @endif
    <a class="navbar-brand" href="{{ route('index') }}">
      <!-- <img src="{{ asset('images/main-logo.png') }}" width="50"> -->
      {{ config('app.short-name', 'Laravel') }}
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav me-auto">
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ms-auto">
        @if(!$dashboard)
          @if(Auth::check())
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
          </li>
          @endif
        @endif
        <!-- Authentication Links -->
        @guest
          @if (Route::has('login'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @endif
          @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
          @endif
        @else
        <li class="nav-item dropdown d-none d-sm-none d-md-block d-lg-block">
          <a id="navbarDropdown" class="nav-link dropdown-toggle me-3" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          <img src="{{ Auth::user()->photo }}" width="30" height="30" class="rounded-circle mx-2 bg-secondary">
          {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <br />
          <small class="d-none">{{ Auth::user()->role->name }}</small>
          </a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('profile.index') }}">
            {{ __('Profile') }}
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
