@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				{{ Breadcrumbs::render('progress.report.create-for-booking', $booking) }}
			</div>
			<div class="col-md-3">
				<div class="card mb-3">
					<div class="card-body">
						@if(!is_null($booking->counselee))
							<img src="{{ asset('images/user.png') }}" alt="" class="img-fluid rounded mx-auto d-block mb-3" height="150" width="150">
							<ul class="list-group">
							  <li class="list-group-item d-flex justify-content-between align-items-center">
							    Name
							    <span>{{  $booking->toCounselee->name }}</span>
							  </li>
							  <li class="list-group-item d-flex justify-content-between align-items-center">
							    Email
							    <span>{{ $booking->toCounselee->email }}</span>
							  </li>
							  <li class="list-group-item d-flex justify-content-between align-items-center">
							    Company
							    <span>{{$booking->toCounselee->client->name }}</span>
							  </li>
							</ul>
						@endif
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
									$readOnly = is_null($report) || $edit_mode ? '' : 'readonly';
								@endphp

								<div class="d-flex justify-content-between mb-3">
									<!-- auth user has role of superadmin can only assign a report to other psychologist-->
									@if(auth()->user()->hasRole('superadmin') && !is_null($report))
										<div>
											<report-assignee report-id="{{ $report->id }}" report-assignee="{{ is_null($report->assignee) ? 'No Assignee' : $report->toAssignee->name }}"></report-assignee>
										</div>
									@endif
									<!-- EDIT REPORT -->
									@if(!$edit_mode)
										<div>
											<a href="{{ route('progress-reports.edit', $booking->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Report">
												<i class="fa fa-edit"></i>
											</a>
										</div>	
									@endif
									<!--  END EDIT REPORT -->
								</div>

								<form action="{{ is_null($report) ? route('progress.report.store') : route('progress.report.update', $report->id) }}" method="POST">
			                        @csrf

			                        @if(!is_null($report))
			                        	@method('PUT')
			                        @endif

			                        @include('alerts.message')

			                        <input type="hidden" name="booking_id" value="{{ $booking->id}}">

			                        <div class="form-group">
			                        	<label>Please select a category that you think is the main concern</label>
			                        	<select name="category" id="category" class="form-control" required  {{$readOnly }}>
			                        		<option value="" selected disabled>Select Category</option>
			                        		@foreach($categories as $category)
			                        			<option value="{{ $category->id }}" {{ !is_null($report) && $report->booking->main_concern == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
			                        		@endforeach
			                        	</select>
			                        </div>

			                        <div class="form-group">
			                              <label>Please explain why you select those category as the main concern</label>
			                              <textarea type="text" name="main_concern" class="form-control" rows="4" {{ $readOnly }}>{{ !is_null($report) ? $report->main_concern : '' }}</textarea>
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
			                                    assignee="{{ is_null($report) || is_null($report->assignee) ? '' : $report->toAssignee->id }}"
			                                    medication="{{ !is_null($report) && $report->has_prescription ? $report->hasMedication->medication : '' }}"
			                                    read-only="{{ $readOnly }}">
			                                    
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
			                              <button class="btn btn-primary btn-block" type="submit" {{ is_null($report) || $edit_mode ? '' : 'disabled' }}>{{ is_null($report) ? 'Submit' : 'Save Changes'}}</button>
			                              <a href="{{ route('booking.answered.questions', $booking->id) }}" class="btn btn-secondary btn-block" data-dismiss="modal">Return</a>
			                        </div>
			                        
			                  </form>
			          		</div>
			          		<div class="tab-pane" id="onboarding-questions" role="tabpanel" aria-labelledby="onboarding-questions-tab">
			          			{{-- @if(auth()->user()->hasRole('psychologist') && $booking->session_type_id == 1) --}}
									
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
									
								{{-- @endif --}}
			          		</div>
			          	</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop