@extends('layouts.dashboard')
@section('content')
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="mb-0">Edit Profile</h3>
    </div>
    <div class="card">
      <div class="card-body">
        <div id="datas">
          @include('shared.edit-profile')
        </div>
      </div>
    </div>
  </div>
@endsection
@section('javascript')
@endsection