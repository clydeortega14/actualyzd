@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">

		<h1>Reschedule a booking</h1>
		<a href="{{ route('home') }}" class="btn btn-outline-secondary mb-3">
			<i class="fa fa-arrow-left"></i>
			<span>Back to Home</span>
		</a>

		<!-- Form for rescheduling -->
		<div class="row">
			<div class="col-md-3">
				<div class="card mb-3">
					<div class="card-body">
						<h5 class="card-title text-secondary">Recent Booking Schedule Summary</h5>

						<ul class="list-group mt-3">
							<li class="list-group-item d-flex justify-content-between align-items-center">
								 Date
					    	    <span>{{ $booking->toSchedule->fullStartDate() }}</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
								 Time
					    	    <span>{{ $booking->time->parseTimeFrom().' - '.$booking->time->parseTimeTo() }}</span>
							</li>
							@if(auth()->user()->hasRole('psychologist'))
								<li class="list-group-item d-flex justify-content-between align-items-center">
									 Counselee
									 @if(is_null($booking->counselee) && count($booking->participants) > 0)
									 	@foreach($booking->participants as $paticipant)
						    	    		<span>{{ $participant->name }}</span> <br>
						    	    	@endforeach

						    	    @else
						    	    	<span>{{ $booking->toCounselee->name }}</span>
						    	    @endif
								</li>
							@else
								<li class="list-group-item d-flex justify-content-between align-items-center">
									Psychologist
									<span>{{ $booking->toSchedule->psych->name }}</span>
								</li>
							@endif
						</ul>
					</div>
				</div>
			</div>

			<div class="col-md-9">

				<h3 class="mb-3">How ?</h3>
				<ol class="mb-3 ml-3 border-bottom">
					<li><p class="lead">Select a rescheduling date in the calendar below.</p></li>
					<li><p class="lead">Upon clicking the date, a modal will shown that will request you to select the rescheduling time.</p></li>
					<li><p class="lead">Then click submit.</p></li>
				</ol>

				<reschedule-calendar></reschedule-calendar>
			</div>

				<!-- Reason for rescheduling -->
				{{-- <div class="col-md-12">
					<div class="card mb-3">
						<div class="card-body">
							<form action="{{ route('booking.reschedule.update', $booking->id) }}" method="POST">
							@csrf
							<div class="form-group row">
								<label class="col-form-label text-md-right col-sm-4">Reason for rescheduling</label>
								<div class="col-sm-6">
									<textarea name="reason" rows="5" class="form-control">{{ !is_null($booking->reschedule) ? $booking->reschedule->reason : ''}}</textarea>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 offset-md-4">
									<button type="submit" class="btn btn-primary">Submit</button>
									<a href="{{ route('home') }}" class="btn btn-danger">Cancel</a>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div> --}}
			
		</div>
		
		<!-- End Form for rescheduling -->
	</div>

@endsection