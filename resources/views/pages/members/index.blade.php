@extends('layouts.app')

@section('css_links')

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/fullcalendar/css/main.css') }}">

@endsection


@section('content')
	
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
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
	            				<div class="card-body">
									<div id="calendar"></div>
									<input type="hidden" name="start_date" value="">
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
	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/date.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/schedules/schedule.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/custom.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/bookings.js') }}"></script>
@endsection