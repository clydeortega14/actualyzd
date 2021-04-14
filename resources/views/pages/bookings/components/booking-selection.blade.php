@php
	$hasBooking = isset($booking) ? true : false;
	$booked_time = $hasBooking ? $booking->toSchedule->toTime->id : '';
	$selected_date = $hasBooking ? $booking->toSchedule->start : '';
@endphp

<div class="col-md-12 col-sm-12 col-xs-12">

	<div class="card mb-3" id="pick-a-time-component" style="display: none;">
		<div class="card-header">
			<div class="d-flex justify-content-between">
				<div>Pick a Time</div>
				<div>
					<label>Selected Date:</label>
					<input type="date" name="start_date" value="{{ $selected_date }}" readonly>
				</div>
			</div>
		</div>

		<div class="card-body">
			<div class="row" id="time-by-date"></div>	
		</div>	
	</div>

	<div class="card mb-3" id="psychologist-component" style="display: none;">
		<div class="card-header">
			Psychologists
		</div>
		<div class="card-body">
			<div class="row" id="psychologist-row">
				@if($hasBooking)
					@php
						$psych = $booking->toSchedule->psych
					@endphp

					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			            <div class="card mb-3 text-center"> 
			                <img src="{{ asset ('sb-admin/img/undraw_profile.svg') }}" alt="Psychologist Image" width="80" height="80" class="mx-auto d-block pt-3">
			                <div class="card-body">
			                    <h5 class="card-title">{{ $psych->name }}</h5>
			                    <div class="form-check">
			                        <input type="radio" name="psychologist" id="psych{{ $psych->id }}" value="{{ $psych->id }}" checked>
			                    </div>
			                </div>
			            </div>
			        </div>
				@else
					<div class="col-md-7 offset-md-3">
						<h4 class="text-center text-gray">Please select date and time</h4>
					</div>
				@endif
			</div>	
		</div>
	</div>

</div>