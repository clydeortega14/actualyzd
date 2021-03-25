@extends('layouts.app')

@section('content')

   <div class="container-fluid">
       <h3>Service Utilization Dashboard</h3>

       <div class="card">
           <div class="card-body">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">Summary</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="utilization-tab" data-toggle="tab" href="#utilization" role="tab" aria-controls="utilization" aria-selected="false">Utilization</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="concerns-tab" data-toggle="tab" href="#concerns" role="tab" aria-controls="concerns" aria-selected="false">Concerns</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <!-- Session date -->
                                <div class="form-group row mt-4">
                                    <label class="col-form-label col-sm-2">Select Date</label>
                                    <div class="col-sm-4">
                                        <select type="combobox" name="select_date" class="form-control">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                 <!-- end session date -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body text-center text-info">
                                                <h5 class="text-info">Consultation</h5>
                                                <div class="mt-4">
                                                    <span>100%</span>
                                                    <div class="d-sm-flex justify-content-around mt-3">
                                                        <div>50</div>
                                                        <div class="border-right"></div>
                                                        <div>24</div>
                                                    </div>

                                                    <div class="d-sm-flex justify-content-around mt-3">
                                                        <div>Limit</div>
                                                        <div></div>
                                                        <div>Usage</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body text-center text-info">
                                                <h5 class="text-info">Webinar</h5>
                                                <div class="mt-4">
                                                    <span>100%</span>
                                                    <div class="d-sm-flex justify-content-around mt-3">
                                                        <div>50</div>
                                                        <div class="border-right"></div>
                                                        <div>24</div>
                                                    </div>

                                                    <div class="d-sm-flex justify-content-around mt-3">
                                                        <div>Limit</div>
                                                        <div></div>
                                                        <div>Usage</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body text-center text-info">
                                                <h5 class="text-info">Group Session</h5>
                                                <div class="mt-4">
                                                    <span>100%</span>
                                                    <div class="d-sm-flex justify-content-around mt-3">
                                                        <div>50</div>
                                                        <div class="border-right"></div>
                                                        <div>24</div>
                                                    </div>

                                                    <div class="d-sm-flex justify-content-around mt-3">
                                                        <div>Limit</div>
                                                        <div></div>
                                                        <div>Usage</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body text-center text-info">
                                                <h5 class="text-info">Hotline</h5>
                                                <div class="mt-4">
                                                    <span>100%</span>
                                                    <div class="d-sm-flex justify-content-around mt-3">
                                                        <div>50</div>
                                                        <div class="border-right"></div>
                                                        <div>24</div>
                                                    </div>

                                                    <div class="d-sm-flex justify-content-around mt-3">
                                                        <div>Limit</div>
                                                        <div></div>
                                                        <div>Usage</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Types of sessions -->
                                
                                <!-- end types of sessions -->

                            </div>
                            <div class="col-md-6">
                                
                                <canvas id="myChart" width="400" height="400"></canvas>
                            </div>
                        </div>
                        
                    </div>


                    <div class="tab-pane fade" id="utilization" role="tabpanel" aria-labelledby="utilization-tab">...</div>
                    <div class="tab-pane fade" id="concerns" role="tabpanel" aria-labelledby="concerns-tab">...</div>
                </div>
           </div>
       </div>
   </div>

@stop

@section('js_scripts')
    
    <script>

        var ctx = document.getElementById('myChart').getContext('2d');
        
        var myChart = new Chart(ctx, {

            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

@endsection


{{-- @extends('layouts.sb-admin.master')


@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Clients</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">105</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Psychologist
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">370</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Counselings(Monthly)
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">1, 392</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop --}}