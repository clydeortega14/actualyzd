@extends('layouts.app')

@section('content')
	

	<div class="container-fluid">
		<div class="row mb-3">
			<div class="col-md-12">
				<h3>Book a session</h3>
				{{ Breadcrumbs::render('booking.date.and.time') }}
			</div>
		</div>

		<div class="row mb-3">
			
			<div class="col-md-3">
				<div class="row mb-3">
					<div class="col-md-12">

						@if(auth()->user()->hasRole('superadmin'))
							<a href="{{ route('booking.select.client.participants') }}">
								<div class="card mb-3">
							  		<div class="card-body">
								    	<h5 class="card-title text-cente p-3">Select session type, client and participants</h5>
								  	</div>
								</div>
							</a>
						@else

							<a href="{{ route('booking.onboarding') }}">
								<div class="card mb-3">
								  	<div class="card-body">
								    	<h5 class="card-title text-center p-3">Onboarding Questions</h5>
								  	</div>
								</div>
							</a>

						@endif

					</div>


					<div class="col-md-12">
						<div class="card text-white bg-primary mb-3">
						  	<div class="card-body">
						    	<h5 class="card-title text-center p-3">Complete booking by selecting date, time and psychologist</h5>
						  	</div>
						</div>
					</div>

				</div>
			</div>

			<div class="col-md-9">

				<form action="{{ route('booking.confirm') }}" method="POST">
					@csrf
					<bookings-calendar
						:has-assessment="{{ $has_assessment }}"
						:is-firsttimer="{{ $is_firsttimer }}"
						:self-harm="{{ $self_harm}}"
						:harm-other-people="{{ $harm_other_people }}"
						:participants="{{ $participants['participants'] }}">
							
					</bookings-calendar>
				</form>

			</div>
		</div>
	</div>

@stop