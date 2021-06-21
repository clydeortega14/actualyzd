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

			          			@php
									$report = $booking->progressReport;
									$user = auth()->user();
									$readOnly = !is_null($report) && $report->assignee == $user->id ? '' : 'readonly';
								@endphp

								@if($user->hasRole('superadmin'))
									<report-assignee 
										report-id="{{ $report->id }}" 
										report-assignee="{{ is_null($report) ? 'No Assignee' : $report->toAssignee->name }}"></report-assignee>
								@endif

			          			<form action="{{ route('progress.report.store') }}" method="POST">
									@csrf

									@include('alerts.message')

									<input type="hidden" name="booking_id" value="{{ $booking->id}}">

									<div class="form-group">
										<label>Main Concern</label>
										<textarea type="text" name="main_concern" class="form-control" rows="4" {{ $readOnly }} >{{ !is_null($report) ? $report->main_concern : '' }}</textarea>
									</div>

									<div class="form-group"> 
										<label>Are there any medications that the client is taking?</label>
										@if($user->hasRole('psychologist'))
											@php
												$user_role = 'psychologist';
											@endphp
										@else
											@php
												$user_role = '';
											@endphp
										@endif
										<!-- client medication -->
										<client-medication 
											has-prescription="{{ !is_null($report) ? $report->has_prescription : '' }}"
											user-role="{{ $user_role }}"
											user-id="{{ $user->id}}"
											assignee="{{ is_null($report) ? 0 : $report->toAssignee->id }}"
											medication="{{ !is_null($report) && $report->has_prescription ? $report->medication->medication : '' }}">
											
										</client-medication>
										<!-- end  client medication-->
									</div>

									<div class="form-group">
										<label>What are your initial assessments of the client and what are her / his core concerns?</label>
										<textarea type="text" name="initial_assessment" class="form-control" rows="4" {{ $readOnly }}>{{ !is_null($report) ? $report->initial_assessment : '' }}</textarea>
									</div>

									<div class="form-group">
										<label>Recommended for follow up session</label>
										<select type="combobox" name="followup_session" class="form-control" {{ $readOnly }}>
											<option> -- Select --</option>
											@foreach($followup_sessions as $followup)
												<option value="{{ $followup->id }}" {{ !is_null($report) && $report->followup_session == $followup->id ? 'selected' : '' }}>{{ $followup->name }}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group">
										<label>What therapy or intervention does your client need?</label>
										<textarea type="text" name="treatment_goal" class="form-control" rows="4" {{ $readOnly }}>{{ !is_null($report) ? $report->treatment_goal : '' }}</textarea>
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