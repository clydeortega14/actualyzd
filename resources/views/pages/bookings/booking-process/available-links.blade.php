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
						<div class="card text-white bg-primary mb-3">
						  	<div class="card-body">
						    	<h4 class="card-title">Choose link to session</h4>
						    	<p class="card-text">We offer some links available and use it as a room during the session.</p>
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
				{{ Breadcrumbs::render('booking.available.links') }}

				<div class="card text-white bg-primary mb-3">
					<div class="card-body text-center">
						<h4 class="card-title">Choose link to session</h4>
						<p class="card-text">We offer some links available and use it as a room during the session.</p>
					</div>
				</div>

				<div class="card mb-3 h-100 py-3">
					<div class="card-body">
						<div class="row justify-content-center">
							<div class="col-md-8">
								<div class="form-group mb-4">
									<p class="card-text">Select one avaiable link that will be use during session</p>
									<div class="custom-control custom-radio mb-2 ml-3">
										<input type="radio" id="1" name="link_to_session" class="custom-control-input">
										<label  class="custom-control-label" for="1">https://meet.jit.si/hello-world</label>
									</div>
									<div class="custom-control custom-radio mb-2 ml-3">
										<input type="radio" id="https://meet.jit.si/session-room-321ds123fffdoe" name="link_to_session" class="custom-control-input">
										<label  class="custom-control-label" for="https://meet.jit.si/session-room-321ds123fffdoe">https://meet.jit.si/session-room-321ds123fffdoe</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop