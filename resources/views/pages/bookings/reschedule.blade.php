@extends('layouts.sb-admin.master')

@section('css_links')

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/fullcalendar/css/main.css') }}">
	<style type="text/css">
		#calendar {
		    max-width: 1100px;
		    margin: 0 auto;
		  }	
	</style>

@endsection


@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-body">
						<div id="calendar"></div>
					</div>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card mb-3">
					<div class="card-header">
						Pick a Time
					</div>
					<div class="card-body">
						<div class="row">
							@foreach($time_lists as $time)
							    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							    	<div class="form-group">
							    		<input type="radio" name="time" value="{{ $time->id }}" required />
							    		<label>{{ $time->parseTimeFrom().' - '.$time->parseTimeTo() }}</label>
							    	</div>
							    </div>
							@endforeach
						</div>	
					</div>	
				</div>

				<div class="card mb-3">
					<div class="card-header">
						Psychologists
					</div>
					<div class="card-body">
						<div class="row" id="psychologist-row">
							<div class="col-md-7 offset-md-3">
								<h4 class="text-center text-gray">Please select date and time</h4>
							</div>
						</div>	
					</div>
				</div>

				<div class="card mb-3">
					<div class="card-body">
						<div class="form-group row">
							<label class="col-form-label text-md-right col-sm-4">Reason for rescheduling</label>
							<div class="col-sm-6">
								<textarea rows="5" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>

				<button class="btn btn-block btn-primary">Resched</button>
				<a href="#" class="btn btn-block btn-danger">Cancel</a>
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