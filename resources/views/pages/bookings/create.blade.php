@extends('layouts.sb-admin.master')

<!-- Custom Style for calendar css -->
@include('externals.calendar-assets.css.style')

@section('content')

	<div class="container">
		
		{{ Breadcrumbs::render() }}

		<form action="{{ route('book.now') }}" method="POST">
			@csrf
			@include('alerts.message')
			<div class="row">

				<!-- Calendar For booking a session -->
				<div class="col-md-12">

					<!-- Select type of session -->
					<div class="card mb-3">
						<div class="card-body">
							<div class="form-group row">
								<label class="col-form-label col-sm-4 text-md-right">Session Type</label>
								<div class="col-sm-6">
									<select name="session_type" class="form-control">
										<option>Individual</option>
										<option>Webinar</option>
										<option>Group</option>
									</select>
								</div>
							</div>
						</div>
					</div>

					<!-- end select type of session -->


					<div class="card mb-3">
						<div class="card-body">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
				<!-- end calendar for booking a session -->

				<!-- Booking Selection -->
				@include('pages.bookings.components.booking-selection')
				<!-- End Booking Selection -->

				<!-- Onboarding Questions --> 
				<div class="col-sm-12" style="display: none;">
					<div class="card mb-3" id="onboarding-questions-component">
						<div class="card-header">
							Tell us a bit about yourself
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group row mb-3">
										<div class="col-sm-7">
											<label for="category">Often the last two weeks, how often have you been bothered by the following problems?</label>
											<ul>
												@foreach($categories as $category)
													@if(count($category->questionnaires) > 0)
	                                                    <li>
	                                                    	<h4 class="text-gray text-info"><strong>{{ $category->name }}</strong></h4>
	                                                    	@include('pages.bookings.components.questionnaire')
	                                                    </li>
													@endif
												@endforeach
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end onboarding questions -->

				<div class="col-sm-12">
					<div class="form-group" style="display:none;" id="btn-submit-booking">
						<button type="submit" class="btn btn-primary btn-block">Submit</button>
						<a href="{{ route('home') }}" class="btn btn-danger btn-block">Cancel</a>
					</div>
				</div>
			</div>
		</form>
	</div>
@stop

<!-- Custom Scripts for calendar scripts -->
@include('externals.calendar-assets.js.script')