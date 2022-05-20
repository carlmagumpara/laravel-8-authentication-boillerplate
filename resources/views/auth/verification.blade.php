@extends('layouts.app')
@section('content')
<div class="container py-5 h-100">
  <div class="row h-100">
    <div class="col-md-6 offset-md-3 h-100 d-flex align-items-center justify-content-center py-3">
      <div class="card bg-transparent border-0 w-100">
        <div class="card-header bg-transparent border-0">
          <h1>{{ __('Verify Email') }}</h1>
        </div>
        <div class="card-body">
          <div class="alert alert-success" role="alert">
            Please check your email for verification code.
          </div>
          <form method="POST" action="{{ route('verification.post') }}" data-ajax="true">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-floating mb-3">
              <input class="form-control" type="text" placeholder="{{ __('Enter Verification Code') }}" name="code" value="{{ old('code') }}">
              <label for="code" class="form-label">Enter Verification Code</label>
              @error('password')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-lg mb-5">
            {{ __('Submit') }}
            </button>
          </form>
          <form method="POST" action="{{ route('verification.resend') }}" data-ajax="true">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <button type="submit" class="btn btn-link p-0 m-0">{{ __('click here to request another') }}</button>.
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
