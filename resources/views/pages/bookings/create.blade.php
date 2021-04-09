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

				<!-- Booking Selection -->
				@include('pages.bookings.components.booking-selection')
				<!-- End Booking Selection -->

				<!-- Onboarding Questions --> 
				<div class="col-sm-12">
					<div class="card mb-3">
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
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Submit</button>
						<a href="#" class="btn btn-danger btn-block">Cancel</a>
					</div>
				</div>
			</div>
		</form>
	</div>
@stop

<!-- Custom Scripts for calendar scripts -->
@include('externals.calendar-assets.js.script')