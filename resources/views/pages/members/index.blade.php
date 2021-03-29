@extends('layouts.sb-admin.master')

@section('content')
	
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">

				<!-- Render Bookings Breadcrumbs -->
				{{ Breadcrumbs::render() }}
				<!-- end render bookings breadcrumb -->

				<ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">Summary</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="scheduler-tab" data-toggle="tab" href="#scheduler" role="tab" aria-controls="scheduler" aria-selected="false">Scheduler</a>
                    </li>
                </ul>

                <div class="tab-content">
                	<div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">
	            		<div class="card mt-3">
	            			<div class="card-body">
	            				<ul class="list-group">
	            					<li class="list-group-item d-flex justify-content-between align-items-center">
	            						<div>
	            							Total Bookings
	            						</div>
	            						<span class="badge badge-primary badge-pill">3</span>
	            					</li>
	            					<li class="list-group-item d-flex justify-content-between align-items-center">
	            						<div>
	            							Upcoming Scheduled Booking
	            						</div>
	            						<span>April 30, 2021 4:00 pm - 5:00 pm</span>
	            					</li>

	            					<li class="list-group-item d-flex justify-content-between align-items-center">
	            						<div>
	            							Cancelled
	            						</div>
	            						<span class="badge badge-danger badge-pill">1</span>
	            					</li>

	            					<li class="list-group-item d-flex justify-content-between align-items-center">
	            						<div>
	            							No Show
	            						</div>
	            						<span class="badge badge-warning badge-pill">1</span>
	            					</li>
	            				</ul>
	            			</div>
	            		</div>
	            	</div>

	            	<div class="tab-pane fade" id="scheduler" role="tabpanel" aria-labelledby="scheduler-tab">
	 
	            		<div class="card mt-3">
	            			<div class="card-body">
	            				<div class="card-header">
	            					<a href="{{ route('bookings.create') }}" class="btn btn-primary form-control">If you want to book a session, Click here</a>
	            				</div>
	            				<div class="card-body">

	            					<div class="table-responsive">
	            						<table class="table table-bordered table-striped table-hover">
	            							<thead>
	            								<tr>
	            									<th>Date</th>
	            									<th>Time</th>
	            									<th>Details</th>
	            									<th>Topic</th>
	            									<th>Link of sessions</th>
	            									<th>Status</th>
	            									<th></th>
	            								</tr>
	            							</thead>

	            							<tbody id="bookings-table"></tbody>
	            						</table>
	            					</div>
								</div>
	            			</div>
	            		</div>
	            	</div>
                </div>
			</div>
		</div>
	</div>

@endsection

@section('js_scripts')
	<script src="{{ asset('assets/fullcalendar/js/bookings.js') }}"></script>
@endsection