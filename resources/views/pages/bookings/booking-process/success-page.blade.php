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
				<div class="row">
					<div class="col-md-12">
						<div class="card mb-3">
						  	<div class="card-body">
						    	<h4 class="card-title">Onboarding Questions</h4>
						    	<p class="card-text">By answering the onboarding questions, it helps the psychologist to determine what is your main concern.</p>
						  	</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card mb-3">
						  	<div class="card-body">
						    	<h4 class="card-title">Choose date and time and psychologist</h4>
						    	<p class="card-text">select available date, time and psychologist.</p>
						  	</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card mb-3">
						  	<div class="card-body">
						    	<h4 class="card-title">Review</h4>
						    	<p class="card-text">Before the system will process your booking please review the session details.</p>
						  	</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card text-white bg-primary mb-3">
						  	<div class="card-body">
						    	<h4 class="card-title">Complete</h4>
						    	<p class="card-text">Thank You!, your session with the psychologist has been created.</p>
						  	</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">

				{{ Breadcrumbs::render('booking.success.page') }}

				
				<div class="card text-white bg-primary mb-3">
				  	<div class="card-body text-center">
				    	<h4 class="card-title">Complete</h4>
				    	<p class="card-text">Thank You!, your session with the psychologist has been created.</p>
				  	</div>
				</div>
				


				<div class="card mb-3">
					<div class="card-body">
						<div class="align-items-center text-center">
							<h3 class="card-title text-center mt-5">
								Thank You!, your session with the psychologist has been created.
							</h3>

							<ul class="list-group mt-5">
							  	@if(session()->has('assessment'))
							  	    <li class="list-group-item d-flex justify-content-between align-items-center">
							    	    Firstimer
							    	    <span>{{ session('assessment.is_firsttimer') ? 'YES' : 'NO'}}</span>
							  	    </li>
							  	    <li class="list-group-item d-flex justify-content-between align-items-center">
							    	    Intent to self harm
							    	    <span>{{ session('assessment.self_harm') ? 'YES' : 'NO' }} </span>
							  	    </li>
							  	@endif
							  	<li class="list-group-item d-flex justify-content-between align-items-center">
							  		Session Type
							  		<span>{{ session()->has('selected_session') ? session('selected_session.name') : 'Individual' }}</span>
							  	</li>
							  	<li class="list-group-item d-flex justify-content-between align-items-center">
							  		Client
							  		<span>{{ session()->has('selected_client') ? session('selected_client.name') : auth()->user()->client->name }}</span>
							  	</li>
							  	<li class="list-group-item d-flex justify-content-between align-items-center">
							  		Counselee / Participants
							  		<span>
							  			@if(session()->has('participants'))
							  			<ul>
							  				@foreach(session('participants') as $participant)
							  				     <li>{{ $participant->name }}</li>
							  				@endforeach
							  			</ul>
							  			@else
							  				<span>{{ auth()->user()->name }}</span>
							  			@endif
							  		</span>
							  	</li>
							  	<li class="list-group-item d-flex justify-content-between align-items-center">
							    	Date and Time
							    	<span>{{ session('booking_details.selected_date') }} @ {{ session('booking_details.timelist.from').' - '.session('booking_details.timelist.to') }}</span>
							  	</li>
							  	<li class="list-group-item d-flex justify-content-between align-items-center">
							    	Psychologist
							    	<span>{{ session('booking_details.schedule.psychologist') }}</span>
							  	</li>
							</ul>
							<a href="{{ route('home') }}" class="btn btn-primary btn-block btn-lg mt-5">Return Home</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
@stop