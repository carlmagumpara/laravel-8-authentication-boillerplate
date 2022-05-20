@extends('layouts.app')
@section('content')
<div class="container py-5 h-100">
  <div class="row h-100">
    <div class="col-md-6 offset-md-3 h-100 d-flex align-items-center justify-content-center py-3">
      <div class="card bg-transparent border-0 w-100">
        <div class="card-header bg-transparent border-0">
          <h1>{{ __('Forgot Password') }}</h1>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('password.email') }}" data-ajax="true">
            @csrf
            <div class="form-floating mb-3">
              <input type="email" class="form-control" name="email" id="floatingInput1" placeholder="{{ __('Email Address') }}">
              <label for="floatingInput1">{{ __('Email Address') }}</label>
            </div>
            <div class="form-check d-none">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
              {{ __('Remember Me') }}
              </label>
            </div>
            <button type="submit" class="btn btn-primary btn-lg mb-5">
            {{ __('Send email link') }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
