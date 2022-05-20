@extends('layouts.app')
@section('content')
<div class="container py-5 h-100">
  <div class="row h-100">
    <div class="col-md-6 offset-md-3 h-100 d-flex align-items-center justify-content-center py-3">
      <div class="card bg-transparent border-0 w-100">
        <div class="card-header bg-transparent border-0">
          <h1>{{ __('Login') }}</h1>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}" data-ajax="true">
            @csrf
            <div class="form-floating mb-3">
              <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="{{ __('Email Address') }}">
              <label for="email" class="form-label">{{ __('Email Address') }}</label>
              @error('email')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="{{ __('Password') }}">
              <label for="password" class="form-label">{{ __('Password') }}</label>
              @error('password')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-check d-none">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
              {{ __('Remember Me') }}
              </label>
            </div>
            <div class="mb-4">
              <a class="btn btn-link p-0 btn-lg" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
              </a>
            </div>
            <button type="submit" class="btn btn-primary btn-lg mb-5">
            {{ __('Login') }}
            </button>
            <div class="text-center">
              <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
