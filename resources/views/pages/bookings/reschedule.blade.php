@extends('layouts.sb-admin.master')

@include('externals.calendar-assets.css.style')


@section('content')
	
	<div class="container">
		<div class="row">
			<!-- Form for rescheduling -->
			<form action="{{ route('booking.reschedule.update', $booking->id) }}" method="POST">
				@csrf

				@method('PUT')
				<!-- Booking Selection -->
					@include('pages.bookings.components.booking-selection')
				<!-- End Booking Selection -->

				<!-- Reason for rescheduling -->
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card mb-3">
						<div class="card-body">
							<div class="form-group row">
								<label class="col-form-label text-md-right col-sm-4">Reason for rescheduling</label>
								<div class="col-sm-6">
									<textarea name="reason" rows="5" class="form-control">{{ !is_null($booking->reschedule) ? $booking->reschedule->reason : ''}}</textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End reason for rescheduling -->

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<button type="submit" class="btn btn-block btn-primary">Resched</button>
					<a href="{{ route('member.home') }}" class="btn btn-block btn-danger">Cancel</a>
				</div>
			</form>
			<!-- End Form for rescheduling -->
		</div>
	</div>

@endsection

@include('externals.calendar-assets.js.script')