@extends('layouts.app')


@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-body">
						<h3 class="card-title text-center mt-5">
							Review Booking Details
						</h3>

						<ul class="list-group mt-5">
						  	<li class="list-group-item d-flex justify-content-between align-items-center">
						    	Firstimer
						    	<p>YES</p>
						  	</li>
						  	<li class="list-group-item d-flex justify-content-between align-items-center">
						    	Intent to self harm
						    	<p>YES</p>
						  	</li>
						  	<li class="list-group-item d-flex justify-content-between align-items-center">
						    	Date and Time
						    	<a href="#">Friday July 9, 2021 @ 9:00 am - 10:00 am</a>
						  	</li>
						  	<li class="list-group-item d-flex justify-content-between align-items-center">
						    	Psychologist
						    	<a href="#">Juan Dela Cruz</a>
						  	</li>
						</ul>


						<div class="row mt-3">
							<div class="col-md-6">
								{{-- <button class="btn btn-primary btn-lg btn-block">Confirm</button> --}}
								<a href="{{ route('booking.success.page') }}" class="btn btn-primary btn-lg btn-block">Confirm Booking</a>
							</div>

							<div class="col-md-6">
								<a href="#" class="btn btn-outline-secondary btn-lg btn-block">Cancel</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop