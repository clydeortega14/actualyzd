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
								{{-- @if(is_null($booking->link_to_session))
									@if(auth()->user()->hasRole('psychologist'))
										<a href="#" data-toggle="modal" data-target="#link-to-session-{{ $booking->id }}" class="mr-3">
											<i class="fa fa-link"></i>
											<span>add link to session</span>
										</a>
										@include('pages.bookings.modals.link-to-session-modal')
									@else
										<span class="badge badge-secondary">link to session will be added soon!</span>
									@endif
								@else
									
								@endif --}}

								@php
									$session_date_time = $booking->toSchedule->start.' '.$booking->time->from;
									$date_now = now()->toDateTimeString();

								@endphp

								@if($booking->toSchedule->start == now()->toDateString() &&
										$booking->time->from >= now()->toTimeString() &&
										($booking->status == 1 || $booking->status == 5)
								)
									<a href="{{ config('app.jitsi_url').$booking->link_to_session }}" target="_blank" class="mr-3">
										<i class="fa fa-video"></i>
										<span class="ml-2">Start Video Call</span>
									</a>
								@endif

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
							<label for="company" class="col-form-label col-sm-4 text-md-right"></label>
							<div class="col-sm-6">
								<h4>Participants</h4>

								@if(auth()->user()->hasRole(['psychologist', 'member', 'superadmin']))

									<ul class="list-unstyled">
										@foreach($booking->participants as $participant)
											{{-- <input type="text" name="participants[]" value="{{ $participant->name }}" readonly class="form-control mb-2" /> --}}
											<li class="mb-0 ml-4">{{ $participant->name }} |
												@foreach($participant->roles as $p_role)
												<span class="badge badge-primary">{{ $p_role->name }}</span>
												@endforeach
											</li>
										@endforeach
									</ul>

								@endif


							</div>
						</div>
						

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Company</label>
							<div class="col-sm-6">
								<input type="text" value="{{ $booking->toClient->name }}" readonly class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Type Of Session</label>
							<div class="col-sm-6">
								<input type="text" value="{{ $booking->sessionType->name }}" readonly class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Date & Time</label>
							<div class="col-sm-6">
								<input type="text" value="{{ date('l, F j, Y', strtotime($booking->toSchedule->start)).' @ '.$booking->time->parseTimeFrom().' - '.$booking->time->parseTimeTo()}}" readonly class="form-control">
							</div>
						</div>

						

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Session Status</label>
							<div class="col-sm-6">
								<input type="text" value="{{ $booking->toStatus->name }}" class="form-control" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="is-firstimer" class="col-form-label col-sm-4 text-md-right">Firstimer / Repeater</label>
							<div class="col-sm-6">
								<input type="text" readonly value="{{ $booking->is_firstimer ? 'Firstimer' : 'Repeater' }}" class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<label for="is-firstimer" class="col-form-label col-sm-4 text-md-right">Intent to self harm</label>
							<div class="col-sm-6">
								<input type="text" readonly value="{{ $booking->self_harm ? 'YES' : 'NO' }}" class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<label for="is-firstimer" class="col-form-label col-sm-4 text-md-right">Intent to harm other people</label>
							<div class="col-sm-6">
								<input type="text" readonly value="{{ $booking->harm_other_people ? 'YES' : 'NO' }}" class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<label for="is-firstimer" class="col-form-label col-sm-4 text-md-right">Status</label>
							<div class="col-sm-6">
								<input type="text" readonly class="form-control" value="{{ $booking->toStatus->name }}">
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