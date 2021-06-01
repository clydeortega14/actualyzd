@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header">
						Session Details
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Start Time</label>
									<input type="time" value="{{ $booking->time->from }}" readonly class="form-control">
								</div>

								<div class="form-group">
									<label>To</label>
									<input type="time" value="{{ $booking->time->to }}" readonly class="form-control">
								</div>

								<div class="form-group">
									<label>Date of session</label>
									<input type="date" value="{{ $booking->toSchedule->start}}" readonly class="form-control">
								</div>

								<div class="form-group">
									<label>Company Name</label>
									<input type="text" value="{{ $booking->toClient->name }}" readonly class="form-control">
								</div>

								<div class="form-group">
									<label>Employee Name</label>
									@if(count($booking->participants) > 0)
										@foreach($booking->participants as $participant)
											<input type="text" value="{{ $participant->name }}" readonly class="form-control mb-2">
										@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-header">Progress Reports</div>
					<div class="card-body">
						<form action="{{ route('progress.report.store') }}" method="POST">
							@csrf

							@include('alerts.message')

							<input type="hidden" name="booking_id" value="{{ $booking->id}}">

							<div class="form-group">
								<label>Main Concern</label>
								<textarea type="text" name="main_concern" class="form-control" rows="4"></textarea>
							</div>

							<div class="form-group"> 
								<label>Are there any medications that the client is taking?</label>
								<!-- client medication -->
								<client-medication 
									has-prescription="" 
									medication="">
									
								</client-medication>
								<!-- end  client medication-->
							</div>

							<div class="form-group">
								<label>What are your initial assessments of the client and what are her / his core concerns?</label>
								<textarea type="text" name="initial_assessment" class="form-control" rows="4"></textarea>
							</div>

							<div class="form-group">
								<label>Recommended for follow up session</label>
								<select type="combobox" name="followup_session" class="form-control">
									<option> -- Select --</option>
									@foreach($followup_sessions as $followup)
										<option value="{{ $followup->id }}" >{{ $followup->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label>What therapy or intervention does your client need?</label>
								<textarea type="text" name="treatment_goal" class="form-control" rows="4"></textarea>
							</div>
							
							<div class="form-group">
								<button class="btn btn-primary btn-block" type="submit">Submit</button>
								<a href="#" class="btn btn-danger btn-block">Cancel</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop