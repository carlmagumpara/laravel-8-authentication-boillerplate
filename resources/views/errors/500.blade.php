@extends('layouts.app')
@section('content')
  <div class="container vh-100">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="clearfix">
          <h1 class="float-left display-3 mr-4">500</h1>
          <h4 class="pt-3">Houston, we have a problem!</h4>
          <p class="text-muted">The page you are looking for is temporarily unavailable.</p>
          @guest
            <a href="{{ route('index') }}" class="btn btn-danger btn-lg me-2">
              Go Home
            </a>
          @else
            <a href="{{ route('dashboard.index') }}" class="btn btn-danger btn-lg me-2">
              Go to Dashboard
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
@section('javascript')
@endsection