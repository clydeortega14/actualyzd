@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">

				<h3>Progress Report</h3>

				{{ Breadcrumbs::render('progress.report.create-for-booking', $booking) }}
				
			</div>
			
			<div class="col-md-3">
				<div class="card mb-3">
					<div class="card-body">
						@if(!is_null($booking->counselee))
							<img src="{{ !is_null($booking->toCounselee->avatar) ? asset('storage/'.$booking->toCounselee->avatar) : asset('images/user.png') }}" alt="" class="img-fluid rounded mx-auto d-block mb-3" height="150" width="150">
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
			                      <a class="nav-link" id="onboarding-questions-tab" data-toggle="tab" href="#onboarding-questions" role="tab" aria-controls="onboarding-questions" aria-selected="true">Assessments</a>
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
									@if($edit_mode || !is_null($report))
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

			                        <input type="hidden" name="counselee" value="{{ $booking->counselee }}">

			                        <div class="form-group">
			                        	<label>Please select a category that you think is the main concern</label>
			                        	<select name="category" id="category" class="form-control"  {{$readOnly }}>
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
			                              <a href="{{ route('progress.report') }}" class="btn btn-secondary btn-block" data-dismiss="modal">Return Home</a>
			                        </div>
			                        
			                  </form>
			          		</div>
			          		<div class="tab-pane" id="onboarding-questions" role="tabpanel" aria-labelledby="onboarding-questions-tab">

			          				<ul>
			          					@if(count($booking->bookedBy->bookings) > 0)
				          					@foreach($booking->bookedBy->bookings()->groupBy('created_at')->orderBy('created_at', 'desc')->get() as $booking_date )
						          				<li>
						          					<h5 class="mb-3">Wed, March 1, 2024</h5>

						          					{{-- @if(count($booking->assessmentAnsers) > 0) --}}

						          						

							          					{{-- <ul class="list-group mb-3 ml-3">
							          					  	@foreach($booking->assessmentAnsers as $answers)
														  		<li class="list-group-item d-flex justify-content-between align-items-center">
														    		{{ $answers->questionnaire->question }}
														    		<span></span>
														  		</li>
															@endforeach
														</ul> --}}
													{{-- @endif --}}
						          				</li>
				          					@endforeach
			          					@endif
			          				</ul>

			          			
			          			{{-- <ul>
									
									<li>
										<div class="mb-3">
											<h5>Are you a first timer or a repeater to this session?</h5>
										</div>
										<div class="ml-3">
											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="is_firsttimer" value="1" id="firstimer" 
													{{ $booking->is_firstimer == 1 ? 'checked' : '' }} disabled>
												<label class="custom-control-label" for="firstimer">First Timer</label>
											</div>

											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="is_firsttimer" value="0" id="repeater" {{ $booking->is_firstimer == 0 ? 'checked' : '' }} disabled>
												<label class="custom-control-label" for="repeater">Repeater</label>
											</div>
										</div>
									</li>

									
									<li>
										<div class="mb-3">
											<h5>I have plans to harm myself?</h5>
										</div>

										<div class="ml-3">
											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="self_harm" value="1" id="1" disabled {{ $booking->self_harm == 1 ? 'checked' : '' }}>
												<label class="custom-control-label" for="1">Yes</label>
											</div>
										

											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="self_harm" value="0" id="0" disabled {{ $booking->self_harm == 0 ? 'checked' : '' }}>
												<label class="custom-control-label" for="0">No</label>
											</div>
										</div>
											
										
										
									</li>
								</ul>
									
								<ul>
									@foreach($categories as $category)
	                                    <li>
	                                    	<div class="mb-3">
	                                    		<h5>{{ $category->name }}</h5>
	                                    	</div>
	                                    	@include('pages.bookings.components.questionnaire')
	                                    </li>
									@endforeach
								</ul> --}}
									
								
			          		</div>
			          	</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop