@extends('layouts.app')


@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-body">
						<div class="align-content-center text-center">
							 <div class="align-content-center text-center">
								<h5 class="card-title">Please review session details</h5>
							</div>
						</div>
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
						  		<span>{{ session('selected_session.name') }}</span>
						  	</li>
						  	<li class="list-group-item d-flex justify-content-between align-items-center">
						  		Client
						  		<span>{{ session('selected_client.name') }}</span>
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
						  				N/A
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