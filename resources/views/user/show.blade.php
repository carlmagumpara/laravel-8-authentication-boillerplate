@extends('layouts.dashboard')
@section('content')
  <div id="student-dashboard">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">User / {{ $user->first_name }} {{ $user->last_name }}</h3>
        <a href="{{ url()->previous() }}" class="btn btn-danger shadow rounded-pill">Back</a>
      </div>
      <div class="mb-3">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="row">
              <div class="col-md-2">
                @include('shared.profile-pic', ['user' => $user, 'currect' => false])
              </div>
              <div class="col-md-10">
                <h1 class="display-6">{{ $user->first_name }} {{ $user->last_name }}</h1>
                <h4 class="text-muted">{{ $user->role->name }}</h4>
                <div class="row">
                  <div class="col-md-3">
                    <div class="dashboard-card px-3 py-2 shadow-sm rounded d-flex justify-content-start align-items-end">
                      <div class="me-3">
                        <img src="{{ asset('images/icons/review.png') }}" style="width: 50px;" />
                      </div>
                      <div>
                        <h3 class="mb-1">{{ \App\Helpers\Utils::ordinal($user->ranking) }}</h3>
                        <p class="mb-0 text-muted">Rank</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="dashboard-card px-3 py-2 shadow-sm rounded d-flex justify-content-start align-items-end">
                      <div class="me-3">
                        <img src="{{ asset('images/icons/choose.png') }}" style="width: 50px;" />
                      </div>
                      <div>
                        <h3 class="mb-1">{{ $user->takes->count() }}</h3>
                        <p class="mb-0 text-muted">Takes</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="dashboard-card px-3 py-2 shadow-sm rounded d-flex justify-content-start align-items-end">
                      <div class="me-3">
                        <img src="{{ asset('images/icons/score-1.png') }}" style="width: 50px;" />
                      </div>
                      <div>
                        <h3 class="mb-1">{{ $score }}</h3>
                        <p class="mb-0 text-muted">Score</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="dashboard-card px-3 py-2 shadow-sm rounded d-flex justify-content-start align-items-end">
                      <div class="me-3">
                        <img src="{{ asset('images/icons/quiz-2.png') }}" style="width: 50px;" />
                      </div>
                      <div>
                        <h3 class="mb-1">{{ $correct }}</h3>
                        <p class="mb-0 text-muted">Corrects</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Quizzes</h4>
      </div>
      @if(count($quiz) !== 0)
      <div class="row mb-3">
        @foreach ($quiz as $key => $data)
        <div class="col-md-4 d-flex align-items-stretch">        
          <div class="card w-100 hvr-shadow border-0 shadow-sm mb-3">
            <a href="#" class="text-decoration-none text-dark">
              @if(count($data->quizImages) !== 0)
              <img src="{{ $data->quizImages[0]->image }}" class="card-img-top card-img-top-custom" alt="...">
              @else
              <img src="{{ asset('images/17973869.jpg') }}" class="card-img-top card-img-top-custom" alt="...">
              @endif
              <div class="card-body">
                <h4 class="card-title">{{ $data->title }}</h4>
                <span class="badge bg-danger mb-3">{{ $data->category->name }}</span>
                <p>{{ $data->description }}</p>
                <p class="mb-0 text-muted"><i class="fas fa-question-circle"></i> Number of Questions: {{ $data->quizQuestions()->count() }}</p>
                <p class="mb-0 text-muted"><i class="fa fa-users"></i> Number of Takers: {{ $data->takes()->count() }}</p>
                <p class="mb-0 text-muted"><i class="fa fa-check-circle"></i> Total Score: {{ $data->quizQuestions()->sum('score') }}</p>
                <p class="mb-0 text-muted"><i class="fa fa-code"></i> Quiz Code: {{ $data->id }}</p>
                <p class="mb-0 text-muted"><i class="fa-solid fa-clock"></i> Total Duration: {{ $data->quizQuestions()->sum('duration') }} Seconds</p>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
      @else
      <div class="p-5 text-center">
        <h3 class="text-muted">No Recent Quiz</h3>
      </div>
      @endif
      <h4 class="mb-3">Recent Takes</h4>
      @if(count($list) !== 0)
      <div class="row mb-3">
        @foreach ($list as $key => $data)
        <div class="col-md-4 d-flex align-items-stretch">
          <div class="card w-100 hvr-shadow border-0 shadow-sm mb-3">
            <a href="#" class="text-decoration-none text-dark">
              @if(count($data->quiz->quizImages) !== 0)
              <img src="{{ $data->quiz->quizImages[0]->image }}" class="card-img-top card-img-top-custom" alt="...">
              @else
              <img src="{{ asset('images/17973869.jpg') }}" class="card-img-top card-img-top-custom" alt="...">
              @endif
              <div class="card-body">
                <h4 class="card-title">{{ $data->quiz->title }}</h4>
                <span class="badge bg-danger mb-3">{{ $data->quiz->category->name }}</span>
                <p>{{ $data->quiz->description }}</p>
                <p class="mb-0 text-muted"><i class="fa fa-comment"></i> Status: {{ $data->status }}</p>
                <p class="mb-0 text-muted"><i class="fas fa-question-circle"></i> Number of Questions: {{ $data->quiz->quizQuestions()->count() }}</p>
                <p class="mb-0 text-muted"><i class="fas fa-qrcode"></i> Quiz Code: {{ $data->id }}</p>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
      @else
      <div class="p-5 text-center">
        <h3 class="text-muted">No Recent Take</h3>
      </div>
      @endif
    </div>
  </div>
@endsection