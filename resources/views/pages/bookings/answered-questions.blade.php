@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('alerts.message')
				{{ Breadcrumbs::render('booking.answered.questions', $booking) }}
			</div>

			<div class="col-md-2">
				<div class="card mb-3">
					<div class="card-header">Actions</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">

								@if($booking->status == 1) <!-- If booking status is booked -->
									@if(auth()->user()->hasRole('psychologist'))
									<div class="mb-3">
										<a href="#" data-toggle="modal" data-target="#complete-session">Complete</a>
										<!-- complete the sesion modal confirmation -->
										@include('pages.bookings.modals.complete-session')
										<!-- end complete the session modal confirmation-->
									</div>
									<div class="mb-3">
										<a href="#" data-toggle="modal" data-target="#no-show">No Show</a>
										<!-- No Show Modal-->
										@include('pages.bookings.modals.no-show-modal')
										<!-- End No Show Modal -->
									</div>
									<div class="mb-3">
										<a href="#">Reschedule</a>
									</div>
									@elseif(auth()->user()->hasRole('member'))
									<div class="mb-3">
										<a href="#" data-toggle="modal" data-target="#cancel-form">Cancel</a>
										<!-- Reason for canceling modal -->
										@include('pages.bookings.modals.cancel-form')
										<!-- end reason for canceling modal -->
									</div>
									@endif
								@else
									@if($booking->status == 4) <!-- if booking status is Cancelled -->
										<div class="text-center mt-2 mb-2">
											<span class="text-danger font-weight-bold text-uppercase">cancelled</span><br>
											<a href="#" data-toggle="modal" data-target="#cancel-form">reason for canselling</a>
											<!-- Reason for canceling modal -->
											@include('pages.bookings.modals.cancel-form')
											<!-- end reason for canceling modal -->
										</div>
									@elseif($booking->status == 2) <!-- if booking status is Completed -->
										<div class="text-center mt-2 mt-2">
											<span class="text-success font-weight-bold text-uppercase">completed</span>
										</div>
									@elseif($booking->status == 3)
										<div class="text-center mt-2 mt-2">
											<span class="text-danger font-weight-bold text-uppercase">No Show</span>
										</div>
									@endif
								@endif

							</div>
						</div>
					</div>
				</div>
			</div>
			

			<div class="col-md-6">
				<div class="card mb-3">
					<div class="card-body">
						<div class="d-flex justify-content-between"></div>
					</div>
				</div>
				<div class="card mb-3">
					<div class="card-header">
						Session Details
					</div>
					<div class="card-body">
						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Company</label>
							<div class="col-sm-6">
								<input type="text" value="{{ $booking->toClient->name }}" readonly class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Counselee</label>
							<div class="col-sm-6">
								@if(count($booking->participants) > 0)
									<ul class="mt-2">
										@foreach($booking->participants as $participant)
											<li>{{ $participant->name }}</li>
										@endforeach
									</ul>
								@else
									<span class="badge badge-secondary">Not Available</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Psychologist</label>
							<div class="col-sm-6">
								<input type="text" value="{{ $booking->toSchedule->psych->name }}" readonly class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Type Of Session</label>
							<div class="col-sm-6">
								<input type="text" value="{{ $booking->sessionType->name }}" readonly class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Date</label>
							<div class="col-sm-6">
								<input type="text" value="{{ date('F j, Y', strtotime($booking->toSchedule->start)) }}" readonly class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Time</label>
							<div class="col-sm-6">
								<input type="text" value="{{ $booking->time->parseTimeFrom().' - '.$booking->time->parseTimeTo() }}" readonly class="form-control">
							</div>
						</div>

						

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Session Status</label>
							<div class="col-sm-6">
								<input type="text" value="{{ $booking->toStatus->name }}" class="form-control" readonly>
							</div>
						</div>

						@if(auth()->user()->hasRole('psychologist'))
							<form action="{{ route('booking.update.main.concern', $booking->id) }}" method="POST">
								@csrf
								@method('PUT')
								<div class="form-group row">
									<label class="col-form-label col-sm-4 text-md-right">Main Concern</label>
									<div class="col-sm-6">
										<div class="input-group mb-3">
		  									<select class="form-control" name="booking_main_concern" aria-describedby="button-addon2">
		  										<option disabled selected> - Concerns -</option>
		  										@foreach($categories as $category)
		  											<option value="{{ $category->id }}" {{ $booking->main_concern == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
		  										@endforeach
		  									</select>
										  	<div class="input-group-append">
										    	<button class="btn btn-primary" type="submit" id="button-addon2">
										    		<i class="fa fa-check"></i>
										    	</button>
										  	</div>
										</div>
									</div>
								</div>
							</form>
						@endif
					</div>
				</div>

				<div class="card mb-3">
					<div class="card-header">Links</div>
					<div class="card-body">
						<div class="form-group row">
							{{-- <label for="company" class="col-form-label col-sm-4 text-md-right">Link to session:</label> --}}
							<div class="col-sm-6 offset-md-4">
								<div class="d-sm-flex justify-content-between">
									<div class="mt-2">
										@if(is_null($booking->link_to_session))
											@if(auth()->user()->hasRole('psychologist'))
												<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#link-to-session-{{ $booking->id }}">
													<i class="fa fa-link"></i>
													<span>add link to session</span>
												</a>
												@include('pages.bookings.modals.link-to-session-modal')
											@else
												<span class="badge badge-secondary">link to session will be added soon!</span>
											@endif
										@else
											<a href="{{ $booking->link_to_session }}" target="_blank">
												<i class="fa fa-video"></i>
												<span class="ml-2">Start Video Call</span>
											</a>
										@endif
									</div>
								</div>
							</div>
						</div>

						@if(!is_null($booking->progressReport))
							<div class="form-group row">
								{{-- <label class="col-form-label col-sm-4 text-md-right">link to progress reports</label> --}}
								<div class="col-sm-6 offset-md-4">
									<div class="mt-2">
										<a href="{{ route('progress-reports.show', $booking->progressReport->id) }}">
											<i class="fa fa-book"></i>
											<span class="ml-2">Progress Reports</span>
										</a>
									</div>
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
			<!-- for users that has role of psychologist and for booking with the session type of individual / consultation -->
			@if(auth()->user()->hasRole('psychologist') && $booking->session_type_id == 1)
				<div class="col-md-4">
					<!-- Onboarding Questions card-->
					<div class="card mb-3">
						<div class="card-header">
							Onboarding questions and answers
						</div>
						<div class="card-body">
							<ol type="I">
								@foreach($categories as $category)
                                    <li>
                                    	<div class="mb-3">
                                    		<h5>{{ $category->name }}</h5>
                                    	</div>
                                    	@include('pages.bookings.components.questionnaire')
                                    </li>
								@endforeach
							</ol>
						</div>
					</div>
					<!-- end Onboarding Questions card-->

					<!-- Progress Reports Card -->
					<div class="card mb-3">
						@php
							$report = $booking->progressReport;
						@endphp
						<div class="card-header">Progress Reports</div>
						<div class="card-body">
							<form action="{{ route('update-progress-report', $report->id) }}" method="POST">
								@csrf
								@method('PUT')
								{{-- @include('alerts.message') --}}
								<div class="form-group">
									<label>Main Concern</label>
									<textarea type="text" name="main_concern" class="form-control" rows="4">{{ !is_null($report->main_concern) ? $report->main_concern : '' }}</textarea>
								</div>
								<div class="form-group"> 
									<label>Are there any medications that the client is taking?</label>
									<div class="form-check">
		  								<input class="form-check-input" type="radio" name="has_prescription" id="yes" value="1" {{ $report->has_prescription ? 'checked' : '' }}>
										<label class="form-check-label" for="yes">Yes</label>
										
									</div>
									<div class="form-check">
		  								<input class="form-check-input" type="radio" name="has_prescription" id="no" value="0" {{ !$report->has_prescription ? 'checked' : '' }}>
										<label class="form-check-label" for="no">No</label>
									</div>
								</div>

								<div class="form-group">
									<label>What are your initial assessments of the client and what are her / his core concerns?</label>
									<textarea type="text" name="initial_assessment" class="form-control" rows="4">{{ !is_null($report->initial_assessment) ? $report->initial_assessment : '' }}</textarea>
								</div>

								<div class="form-group">
									<label>Recommended for follow up session</label>
									<select type="combobox" name="followup_session" class="form-control">
										<option> -- Select --</option>
										@foreach($followup_sessions as $followup)
											<option value="{{ $followup->id }}" {{ !is_null($report->followup_session) && $report->followup_session == $followup->id ? 'selected' : '' }}>{{ $followup->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group">
									<label>What therapy or intervention does your client need?</label>
									<textarea type="text" name="treatment_goal" class="form-control" rows="4">{{ !is_null($report->treatment_goal)  ? $report->treatment_goal : '' }}</textarea>
								</div>
								
								<div class="form-group">
									<button class="btn btn-primary btn-block" type="submit">Submit</button>
									<a href="#" class="btn btn-danger btn-block">Cancel</a>
								</div>
							</form>
						</div>
					</div>
					<!-- Progress Reports Card -->
				</div>
			@endif
			<!-- end for users that has role of psychologist and for booking with the session type of individual / consultation -->
		</div>
	</div>
@endsection