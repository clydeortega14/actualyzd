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
						@if(auth()->user()->hasRole('superadmin'))
							<div class="card mb-3">
						  		<div class="card-body">
							    	<h4 class="card-title">Select session type, client and participants</h4>
							    	<p class="card-text">Select session type, client and participants of the session</p>
							  	</div>
							</div>
						@else

							<div class="card mb-3">
							  	<div class="card-body">
							    	<h4 class="card-title">Onboarding Questions</h4>
							    	<p class="card-text">By answering the onboarding questions, it helps the psychologist to determine what is your main concern.</p>
							  	</div>
							</div>

						@endif
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
						<div class="card text-white bg-primary mb-3">
						  	<div class="card-body">
						    	<h4 class="card-title">Review</h4>
						    	<p class="card-text">Before the system will process your booking please review the session details.</p>
						  	</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card mb-3">
						  	<div class="card-body">
						    	<h4 class="card-title">Complete</h4>
						    	<p class="card-text">You have successfully booked a session.</p>
						  	</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">

				@if($errors->any())
					@foreach($errors->all() as $error)
					<div class="alert alert-danger" role="alert">
  						{{ $error }}
					</div>
					@endforeach
				@endif

				@if(session()->has('error'))

					<div class="alert alert-danger" role="alert">
  						{{ session('error') }}
					</div>
				@endif
				
				{{ Breadcrumbs::render('booking.review.details') }}

				<div class="card text-white bg-primary mb-3">
					<div class="card-body text-center">
						<h4 class="card-title">Review</h4>
						<p class="card-text">Before the system will process your booking please review the session details.</p>
					</div>
				</div>

				<div class="card mb-3">
					<div class="card-body">
						
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
									<a href="{{ route('booking.date.and.time') }}" class="btn btn-secondary btn-lg btn-block">Return to previous</a>
								</div>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>

@stop