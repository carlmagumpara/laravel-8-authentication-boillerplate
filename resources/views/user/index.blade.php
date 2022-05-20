@extends('layouts.dashboard')
@section('content')
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="mb-0 text-capitalize">{{ $type }}</h3>
      <div>
        @include('shared.create-user')
      </div>
    </div>
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white py-3">
        <div class="row">
          <div class="col-md-8 d-flex justify-content-start align-items-center">
            <h5 class="mb-0">List</h5>
          </div>
          <div class="col-md-4">
            <div class="input-group">
              <input 
                type="text" 
                class="form-control search-data border-right-0"
                data-url="{{ url()->full() }}"
                data-target="#datas"
                placeholder="Search ..." 
              >
              <div class="input-group-append">
                <button class="btn btn-outline-secondary border-left-0 border bg-white" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div id="datas">
            @include('user.list')
        </div>
      </div>
    </div>
  </div>
@endsection
@section('javascript')
@endsection