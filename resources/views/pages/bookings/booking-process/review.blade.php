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
						    	<span>{{ session('assessment.is_firsttimer') ? 'YES' : 'NO'}}</span>
						  	</li>
						  	<li class="list-group-item d-flex justify-content-between align-items-center">
						    	Intent to self harm
						    	<span>{{ session('assessment.self_harm') ? 'YES' : 'NO' }} </span>
						  	</li>
						  	<li class="list-group-item d-flex justify-content-between align-items-center">
						    	Date and Time
						    	<span>
						    		<a href="#">{{ session('booking_details.selected_date') }} @ {{ session('booking_details.timelist.from').' - '.session('booking_details.timelist.to') }}</a>
						    	</span>
						  	</li>
						  	<li class="list-group-item d-flex justify-content-between align-items-center">
						    	Psychologist
						    	<span>
						    		<a href="#">{{ session('booking_details.schedule.psychologist') }}</a>
						    	<span>
						  	</li>
						</ul>

						<form action="{{ route('booking.confirm') }}" method="POST">
							@csrf
							<div class="row mt-3">
								<div class="col-md-6">
									<button class="btn btn-primary btn-lg btn-block">Confirm</button>
								</div>

								<div class="col-md-6">
									<a href="#" class="btn btn-outline-secondary btn-lg btn-block">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop