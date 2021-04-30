@extends('layouts.sb-admin.master')

@section('content')

   <div class="container-fluid">
       <h3>Service Utilization Dashboard</h3>

       <div class="row">

            <!-- List of clients for admin only -->
            @if(auth()->user()->hasRole('superadmin'))
                <div class="col-md-3">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active disabled">Overall</a>
                        <a href="#" class="list-group-item list-group-item-action">Company A</a>
                        <a href="#" class="list-group-item list-group-item-action">Company B</a>
                    </div>
                </div>
            @endif
            <!-- -->

           <!-- Content -->
           <div class="{{ auth()->user()->hasRole('superadmin') ? 'col-md-9' : 'col-md-12' }}">

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
                            <div class="col-md-3">
                                <div class="card">
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

                            <div class="col-md-3">
                                <div class="card">
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
                            <div class="col-md-3">
                                <div class="card">
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

                            <div class="col-md-3">
                                <div class="card">
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


                            <div class="col-md-12">
                                <div class="card mt-3 mb-3">
                                    <div class="card-body">
                                        <canvas id="myChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Utilization Tab -->
                    <div class="tab-pane fade" id="utilization" role="tabpanel" aria-labelledby="utilization-tab">
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        Consultation Service
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <th>Month</th>
                                                        <th>First Timers</th>
                                                        <th>Repeaters</th>
                                                        <th>Cancelled</th>
                                                        <th>No Show</th>
                                                        <th>Completed</th>
                                                        <th>Pending Rescheduling</th>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <th>Date</th>
                                                        <th>30</th>
                                                        <th>19</th>
                                                        <th>11</th>
                                                        <th>5</th>
                                                        <th>65</th>
                                                        <th>4</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>3/2/2021</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>0</td>
                                                        <td>3</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3/3/2021</td>
                                                        <td>2</td>
                                                        <td>2</td>
                                                        <td>0</td>
                                                        <td>0</td>
                                                        <td>4</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3/3/2021</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>4</td>
                                                        <td>1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                
                                <div class="card mb-3">
                                    <div class="card-header">
                                        Utilization Rate
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Services</th>
                                                        <th>Limit</th>
                                                        <th>Usage</th>
                                                        <th>Percentage</th>
                                                        <th>Completion Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Consultation</td>
                                                        <td>60</td>
                                                        <td>65</td>
                                                        <td>80%</td>
                                                        <td>3/15/2020</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Group Session</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>100%</td>
                                                        <td>3/28/2020</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Webinar</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>100%</td>
                                                        <td>3/27/2020</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hotline</td>
                                                        <td>60</td>
                                                        <td>20</td>
                                                        <td>33%</td>
                                                        <td>3/30/2020</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Services</th>
                                                        <th>MTD</th>
                                                        <th>QTD</th>
                                                        <th>YTD</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Consultation</td>
                                                        <td>66</td>
                                                        <td>195</td>
                                                        <td>780</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Group Session</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>12</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Webinar</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>12</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hotline</td>
                                                        <td>60</td>
                                                        <td>20</td>
                                                        <td>720</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- End Utilization tab-->

                <!-- concerns tab-->
                <div class="tab-pane fade" id="concerns" role="tabpanel" aria-labelledby="concerns-tab">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <!--  Consulation service -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    Consultation Service
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Month</th>
                                                    <th>Mental Challenges</th>
                                                    <th>Work Issues</th>
                                                    <th>Personal Problems</th>
                                                    <th>Intent to Self harm</th>
                                                </tr>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>30</th>
                                                    <th>19</th>
                                                    <th>11</th>
                                                    <th>5</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>3/2/2021</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>3/3/2021</td>
                                                    <td>2</td>
                                                    <td>2</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>3/4/2021</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--  end Consulation service -->
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Services</th>
                                                    <th>MTD</th>
                                                    <th>QTD</th>
                                                    <th>YTD</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Mental Challenges</td>
                                                    <td>30</td>
                                                    <td>120</td>
                                                    <td>380</td>
                                                </tr>
                                                <tr>
                                                    <td>Work Issues</td>
                                                    <td>19</td>
                                                    <td>1</td>
                                                    <td>228</td>
                                                </tr>
                                                <tr>
                                                    <td>Personal Problems</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>132</td>
                                                </tr>
                                                <tr>
                                                    <td>Intent to Self Harm</td>
                                                    <td>5</td>
                                                    <td>20</td>
                                                    <td>60</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end concerns tab-->
                </div>
           </div>
           <!-- end content -->
       </div>
   </div>

@stop

@section('js_scripts')

    <!-- Moment Js -->
    <script type="text/javascript" src="{{ asset('assets/momentjs/js/moment.js') }}"></script>

    <!-- Chart Js -->
    <script type="text/javascript" src="{{ asset('assets/chart-js/js/Chart.js') }}"></script>
    
    <script>

        var ctx = document.getElementById('myChart').getContext('2d');
        
        var myChart = new Chart(ctx, {

            type: 'bar',
            data: {
                labels: ['2020 Sept', '2020 Oct', '2020 Nov', '2020 Dec', '2021 Jan', '2021 Feb'],
                datasets: 
                [
                    {
                        label: 'Mental Challenges',
                        data: [10, 13, 23, 5, 64, 10],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Suicidal Intent',
                        data: [21, 16, 20, 15, 54, 30],
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Wellbeing Issues',
                        data: [20, 28, 17, 20, 50, 33],
                        backgroundColor:'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
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