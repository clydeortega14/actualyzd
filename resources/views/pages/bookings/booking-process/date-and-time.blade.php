@extends('layouts.app')

@section('content')
	

	<div class="container-fluid">
		<h1>Book a session</h1>
		<a href="{{ route('home') }}" class="btn btn-outline-secondary mb-3">
			<i class="fa fa-arrow-left"></i>
			<span>Back to Home</span>
		</a>

		<div class="row">
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

				{{ Breadcrumbs::render('booking.date.and.time') }}

				<div class="card text-white bg-primary mb-3">
					<div class="card-body text-center">
						<h4 class="card-title">Choose date and time and psychologist</h4>
						<p class="card-text">select available date, time and psychologist.</p>
					</div>
				</div>

				<div class="card mb-3">
					<div class="card-body">

						<h5 class="card-title text-center">Recent Schedule</h5>

						<ul class="list-group mt-3">
							<li class="list-group-item d-flex justify-content-between align-items-center">
								 Date
					    	    <span>{{ session('booking')['toSchedule']['start'] }}</span>
							</li>
						</ul>
					</div>
				</div>

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