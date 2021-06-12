@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="schedules-tab" data-toggle="tab" href="#schedules" role="tab" aria-controls="schedules" aria-selected="false">Schedules</a>
                </li>
                <li class="nav-item" role="presentation">
                      <a class="nav-link" id="bookings-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="bookings" aria-selected="true">Bookings</a>
                </li>
                <li class="nav-item" role="presentation">
                      <a class="nav-link" id="progress-reports-tab" data-toggle="tab" href="#progress-reports" role="tab" aria-controls="progress-reports" aria-selected="false">Progress Reports</a>
                </li>
          </ul>

          <div class="tab-content">

            <div class="tab-pane fade show active" id="schedules" role="tabpanel" aria-labelledby="schedules-tab">
                  <div class="mt-4">
                      <schedules-component></schedules-component>
                  </div>
            </div>

          	<div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
          		<div class="mt-4">
          			Bookings
          		</div>
          	</div>
          	<div class="tab-pane fade" id="progress-reports" role="tabpanel" aria-labelledby="progress-reports-tab">
          		<div class="mt-4">
          			<div class="row">
          				Progress reports
          		</div>
          	</div>
                
          </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection