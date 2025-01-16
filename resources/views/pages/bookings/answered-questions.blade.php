@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="mb-3">Session Details</h3>

				@include('alerts.message')
				{{-- {{ Breadcrumbs::render('booking.answered.questions', $booking) }} --}}
			</div>

			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header">
						<div class="d-sm-flex justify-content-between">
							<div>
								

								@php
									$session_date_time = $booking->toSchedule->start.' '.$booking->time->from;
									$date_now = now()->toDateTimeString();

								@endphp

								
								
								

								@if($booking->session_type_id == 1 && auth()->user()->hasRole(['psychologist', 'superadmin']))

									@if(!is_null($booking->toCounselee))

										@php
											$previous_report = $booking->toCounselee->progressReports()->latest()->first(); 
										@endphp

										@if(!is_null($previous_report))
											<a href="{{ route('progress.report.create-for-booking', $previous_report->booking_id) }}" class="mr-3" target="_blank">
												<i class="fa fa-book"></i>
												<span>Progress Report</span>
											</a>
										@endif
									@endif
								@endif
							</div>

							<div>
								<booking-status 
									session-status="{{ $booking->toStatus->name }}" 
									:booking-id="{{ $booking->id }}"
									:booking-status="{{ $booking->toStatus->id }}"
									@if(!is_null($booking->reschedule ))
										:reschedule="{{ $booking->reschedule }}"
									@endif
									
									:cancelled="{{ $booking }}"
									
									:own-booking="{{ $booking->load(['cancelled', 'reschedule', 'toStatus']) }}"
									>
										
								</booking-status>

							</div>
						</div>	
					</div>
					<div class="card-body">

						{{-- <div class="mb-3">
							<img src="{{ (is_null($booking->toCounselee) && is_null($booking->toCounselee->avatar)) ? '/images/user.png' : asset('storage/'.$booking->toCounselee->avatar) }}" alt="{{ $booking->toCounselee->name }}" class="mx-auto d-block rounded-circle img-fluid ac-avatar">
						</div> --}}

						
						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right"><i class="fa fa-calendar"></i></label>
							<div class="col-sm-6">
								<!-- <input type="text" value="" readonly class="form-control"> -->
								 <h5 class="card-title"><b>{{ $booking->sessionType->name }}</b> <br />
									<small>{{ date('l, F j, Y', strtotime($booking->toSchedule->start)).' @ '.$booking->time->parseTimeFrom().' - '.$booking->time->parseTimeTo()}}</small>
								</h5>
								 <p class="card-text mt-0">
								 	
								 </p>
							</div>
						</div>

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right"><i class="fa fa-video"></i></label>
							<div class="col-sm-6">
								<a href="{{ config('app.jitsi_url').$booking->link_to_session }}" target="_blank" class="mr-3 btn btn-primary btn-lg">
									<span class="ml-2">Join Session</span>
								</a> <br />
								<small>{{ config('app.jitsi_url').$booking->link_to_session }}</small>
							</div>
						</div>
						

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right"><i class="fas fa-building"></i></label>
							<div class="col-sm-6">
								<!-- <input type="text" value="" readonly class="form-control"> -->
								 <h5 class="card-title mt-2">{{ $booking->toClient->name }}</h5>
							</div>
						</div>

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right"><i class="fa fa-users"></i></label>
							<div class="col-sm-6">
								
								<ul class="list-unstyled">
									@foreach($booking->participants as $participant)
										{{-- <input type="text" name="participants[]" value="{{ $participant->name }}" readonly class="form-control mb-2" /> --}}
										<li class="">{{ $participant->name }} |
											@foreach($participant->roles as $p_role)
											<span class="badge badge-primary">{{ $p_role->name }}</span>
											@endforeach
										</li>
									@endforeach
								</ul>
								 
							</div>
						</div>

						

					</div>
				</div>
			</div>
			<!-- for users that has role of psychologist and for booking with the session type of individual / consultation -->
			
			<!-- end for users that has role of psychologist and for booking with the session type of individual / consultation -->
		</div>
	</div>
@endsection