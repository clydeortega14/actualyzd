@extends('layouts.app')

@section('content')
	

	<div class="container-fluid">

		<h3>Rescheduling a session</h3>


		

		<!-- Form for rescheduling -->
		<div class="row">
			
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header">
						Session Summary
					</div>
					<div class="card-body">
						

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

			<div class="col-md-12">

				<reschedule-calendar 
					:booking="{{ $booking }}"
					:user="{{ auth()->user() }}">
						
				</reschedule-calendar>
			</div>
			
		</div>
		
		<!-- End Form for rescheduling -->
	</div>

@endsection