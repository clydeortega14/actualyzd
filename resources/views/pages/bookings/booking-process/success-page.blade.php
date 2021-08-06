@extends('layouts.app')


@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-body">
						<div class="align-items-center text-center">
							<h3 class="card-title text-center mt-5">
								You have successfully booked a session!
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
							<a href="{{ route('home') }}" class="btn btn-primary btn-block mt-5">Return Home</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop