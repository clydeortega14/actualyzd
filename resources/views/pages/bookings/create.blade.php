@extends('layouts.sb-admin.master')

@section('css_links')

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/fullcalendar/css/main.css') }}">

@endsection

@section('content')

	<div class="container">
		<form action="{{ route('book.now') }}" method="POST">
			@csrf

			<div class="row justify-content-center">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="card mb-3">
						<div class="card-body">
							<div id="calendar"></div>
							<input type="hidden" name="start_date" value="">
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
								    		<input type="radio" name="time" value="{{ $time->id }}" />
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
				</div>
				<div class="col-sm-12">
					<div class="card mb-3">
						<div class="card-header">
							Tell us a bit about yourself
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group row mb-3">
										<div class="col-sm-7 offset-sm-3">
											<label for="category">Often the last two weeks, how often have you been bothered by the following problems?</label>
											<select type="combobox" name="category" id="category" class="form-control">
												<option value="">Choose Category</option>
												@foreach($categories as $category)
													<option value="{{ $category->id }}">{{ $category->name }}</option>
												@endforeach
											</select>

											<div id="category-questionnaire" class="mt-4"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Submit</button>
						<a href="#" class="btn btn-danger btn-block">Cancel</a>
					</div>
				</div>
			</div>
		</form>
	</div>
@stop

@section('js_scripts')
	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/date.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/schedules/schedule.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/custom.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/bookings.js') }}"></script>
@endsection