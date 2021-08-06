@extends('layouts.app')

@section('content')
	
	<div class="container">
		<!-- Form for rescheduling -->
		
		<div class="row">
			
				<!-- Booking Selection -->
					{{-- @include('pages.bookings.components.booking-selection') --}}
				<!-- End Booking Selection -->

				<!-- Reason for rescheduling -->
				<div class="col-md-12">
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
				</div>
			
		</div>
		
		<!-- End Form for rescheduling -->
	</div>

@endsection