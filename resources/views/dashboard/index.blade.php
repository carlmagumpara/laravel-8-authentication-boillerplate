@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <div class="row mb-4">
    <div class="col-sm-8">
      <h3 class="mb-0">Dashboard</h3>
    </div>
    <div class="col-sm-4 d-flex justify-content-end align-items-center">
    </div>
  </div>
  <div class="row text-center">
    <div class="col-md-3 mb-3">
      <a href="#" class="text-decoration-none text-dark" role="button">
        <div class="counter hvr-grow w-100 d-flex justify-content-between align-items-center p-3">
          <img src="{{ asset('images/icons/team-2.png') }}" class="fa-2x me-2">
          <div>
            <h2 class="timer count-title count-number" data-to="100" data-speed="1500">0</h2>
            <p class="count-text ">Users</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3 mb-3">
      <a href="#" class="text-decoration-none text-dark" role="button">
        <div class="counter hvr-grow w-100 d-flex justify-content-between align-items-center p-3">
          <img src="{{ asset('images/icons/team-2.png') }}" class="fa-2x me-2">
          <div>
            <h2 class="timer count-title count-number" data-to="100" data-speed="1500">0</h2>
            <p class="count-text ">Users</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3 mb-3">
      <a href="#" class="text-decoration-none text-dark" role="button">
        <div class="counter hvr-grow w-100 d-flex justify-content-between align-items-center p-3">
          <img src="{{ asset('images/icons/team-2.png') }}" class="fa-2x me-2">
          <div>
            <h2 class="timer count-title count-number" data-to="100" data-speed="1500">0</h2>
            <p class="count-text ">Users</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3 mb-3">
      <a href="#" class="text-decoration-none text-dark" role="button">
        <div class="counter hvr-grow w-100 d-flex justify-content-between align-items-center p-3">
          <img src="{{ asset('images/icons/team-2.png') }}" class="fa-2x me-2">
          <div>
            <h2 class="timer count-title count-number" data-to="100" data-speed="1500">0</h2>
            <p class="count-text ">Users</p>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-md-12 d-flex align-items-stretch">
      <div class="card w-100 border-0 shadow-sm mb-3">
        <div class="card-header bg-white border-0">
          Latest Registration Chart
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="admin-dbchart" style="height: 500px"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@section('javascript')
<script type="text/javascript">
  window.eightMonths = {!! $chart['eightMonths'] !!};
  window.eightMonthsData = {!! $chart['eightMonthsData'] !!};

  const admin_dbchart = document.getElementById('admin-dbchart');

  new Chart(admin_dbchart, {
      type: 'line',
      data: {
        labels: window.eightMonths,
        datasets: Object.keys(window.eightMonthsData).map(chart => ({
          label: chart,
          data: window.eightMonthsData[chart],
        })),
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            ticks: {
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                  return `${value}`;
              }
            }
          },
          xAxes: [{
            ticks: {
              precision: 0,
            }
          }]
        }
      }
  });
</script>
@endsection

@endsection