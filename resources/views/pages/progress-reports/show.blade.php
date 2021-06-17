@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="card mb-3">
					<div class="card-body">
						<img src="{{ asset('images/user.png') }}" alt="" class="img-fluid rounded mx-auto d-block" height="150" width="150">
						<div class="text-center mt-3">
							<h5>{{ $booking->participants[0]->name }}</h5>

							<img src="{{ asset('images/logo1.png') }}" alt="" class="img-fluid rounded mx-auto d-block" height="55" width="55">
						</div>
						{{-- <div class="row">
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
						</div> --}}
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="card mb-3">
					
					<div class="card-body">

						<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
			                <li class="nav-item" role="presentation">
			                      <a class="nav-link active" id="reports-tab" data-toggle="tab" href="#reports" role="tab" aria-controls="reports" aria-selected="false">Progress Reports</a>
			                </li>
			                <li class="nav-item" role="presentation">
			                      <a class="nav-link" id="onboarding-questions-tab" data-toggle="tab" href="#onboarding-questions" role="tab" aria-controls="onboarding-questions" aria-selected="true">Onboarding Questions</a>
			                </li>
			          	</ul>

			          	<div class="tab-content mt-3">
			          		<div class="tab-pane fade show active" id="reports" role="tabpanel" aria-labelledby="reports-tab">
			          			<form action="{{ route('progress.report.store') }}" method="POST">
									@csrf

									@include('alerts.message')

									@php
										$report = $booking->progressReport;
									@endphp

									<input type="hidden" name="booking_id" value="{{ $booking->id}}">

									<div class="form-group">
										<label>Main Concern</label>
										<textarea type="text" name="main_concern" class="form-control" rows="4">{{ !is_null($report) ? $report->main_concern : '' }}</textarea>
									</div>

									<div class="form-group"> 
										<label>Are there any medications that the client is taking?</label>
										<!-- client medication -->
										<client-medication 
											has-prescription="{{ !is_null($report) ? $report->has_prescription : '' }}" 
											medication="{{ !is_null($report) && $report->has_prescription ? $report->medication->medication : '' }}">
											
										</client-medication>
										<!-- end  client medication-->
									</div>

									<div class="form-group">
										<label>What are your initial assessments of the client and what are her / his core concerns?</label>
										<textarea type="text" name="initial_assessment" class="form-control" rows="4">{{ !is_null($report) ? $report->initial_assessment : '' }}</textarea>
									</div>

									<div class="form-group">
										<label>Recommended for follow up session</label>
										<select type="combobox" name="followup_session" class="form-control">
											<option> -- Select --</option>
											@foreach($followup_sessions as $followup)
												<option value="{{ $followup->id }}" {{ !is_null($report) && $report->followup_session == $followup->id ? 'selected' : '' }}>{{ $followup->name }}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group">
										<label>What therapy or intervention does your client need?</label>
										<textarea type="text" name="treatment_goal" class="form-control" rows="4">{{ !is_null($report) ? $report->treatment_goal : '' }}</textarea>
									</div>
									
									<div class="form-group">
										<button class="btn btn-primary btn-block" type="submit">Submit</button>
										<a href="#" class="btn btn-secondary btn-block">Cancel</a>
									</div>
								</form>
			          		</div>
			          		<div class="tab-pane" id="onboarding-questions" role="tabpanel" aria-labelledby="onboarding-questions-tab">
			          			@if(auth()->user()->hasRole('psychologist') && $booking->session_type_id == 1)
									
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
									
								@endif
			          		</div>
			          	</div>

						
					</div>
				</div>
			</div>
		</div>
	</div>

@stop