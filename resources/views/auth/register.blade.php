@extends('layouts.app')
@section('content')
<div class="container py-5 h-100">
  <div class="row h-100">
    <div class="col-md-6 offset-md-3 h-100 d-flex align-items-center justify-content-center py-3">
      <div class="card bg-transparent border-0 w-100">
        <div class="card-header bg-transparent border-0">
          <h1 class="text-capitalize">@if(! empty($as)) {{ $as }} {{ __('Registration') }} @else {{ __('Register') }} @endif</h1>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}" data-ajax="true">
            @csrf
            <input type="hidden" name="role_id" value="1">
            <div class="form-floating mb-3">
              <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus placeholder="{{ __('First Name') }}">
              <label for="first_name" class="">{{ __('First Name') }}</label>
              @error('first_name')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-floating mb-3">
              <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus placeholder="{{ __('Last Name') }}">
              <label for="last_name" class="">{{ __('Last Name') }}</label>
              @error('last_name')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-floating mb-3">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="{{ __('Email Address') }}">
              <label for="email" class="">{{ __('Email Address') }}</label>
              @error('email')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-floating mb-3">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="{{ __('Password') }}">
              <label for="password" class="">{{ __('Password') }}</label>
              @error('password')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-floating mb-3">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
              <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
              @error('password')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <p>Registering means that you agree with our <a href="#" class="">Privacy Policy</a></p>
            <button type="submit" class="btn btn-primary btn-lg mb-5">
            {{ __('Register') }}
            </button>
            <div class="text-center">
              <p>Have an account? <a href="{{ route('login') }}">Login</a></p>
            </div> 
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
