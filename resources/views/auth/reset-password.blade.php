@extends('layouts.app')
@section('content')
<div class="container py-5 h-100">
  <div class="row h-100">
    <div class="col-md-6 offset-md-3 h-100 d-flex align-items-center justify-content-center py-3">
      <div class="card bg-transparent border-0 w-100">
        <div class="card-header bg-transparent border-0">
          <h1>{{ __('Reset Password') }}</h1>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('password.update') }}" data-ajax="true">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-floating mb-3">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ \Request::get('email') }}" required autofocus readonly placeholder="{{ __('Email Address') }}">
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
            <button type="submit" class="btn btn-primary btn-lg mb-5">
            {{ __('Reset Password') }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
