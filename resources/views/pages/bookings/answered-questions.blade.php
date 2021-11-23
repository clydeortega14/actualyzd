@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3 class="mb-3">Session Details</h3>

				@include('alerts.message')
				{{-- {{ Breadcrumbs::render('booking.answered.questions', $booking) }} --}}
			</div>

			<div class="col-md-8">
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

								@if($booking->status == 1 || $booking->status == 5)
									<a href="{{ config('app.jitsi_url').$booking->link_to_session }}" target="_blank" class="mr-3">
										<i class="fa fa-video"></i>
										<span class="ml-2">Start Video Call</span>
									</a>
								@endif

								@if($booking->session_type_id == 1 && auth()->user()->hasRole('psychologist'))

									@if(!is_null($booking->toCounselee))

										@php
											$previous_report = $booking->toCounselee->progressReports()->latest()->first(); 
										@endphp

										@if(!is_null($previous_report))
											<a href="{{ route('progress.report.create-for-booking', $previous_report->booking_id) }}" class="mr-3">
												<i class="fa fa-book"></i>
												<span>Report</span>
											</a>
										@endif
									@endif
								@endif
							</div>
						</div>	
					</div>
					<div class="card-body">

						{{-- <div class="mb-3">
							<img src="{{ (is_null($booking->toCounselee) && is_null($booking->toCounselee->avatar)) ? '/images/user.png' : asset('storage/'.$booking->toCounselee->avatar) }}" alt="{{ $booking->toCounselee->name }}" class="mx-auto d-block rounded-circle img-fluid ac-avatar">
						</div> --}}

						<div class="form-group row">
							<label for="company" class="col-form-label col-sm-4 text-md-right">Company</label>
							<div class="col-sm-6">
								<input type="text" value="{{ $booking->toClient->name }}" readonly class="form-control">
							</div>
						</div>

						@if(auth()->user()->hasRole('psychologist'))
							<div class="form-group row">
								<label for="company" class="col-form-label col-sm-4 text-md-right">Counselee</label>
								<div class="col-sm-6">
									@if(is_null($booking->counselee) && count($booking->participants) > 0)


										{{-- <ul class="mt-2"> --}}
											@foreach($booking->participants as $participant)
											<input type="text" name="participants[]" value="{{ $participant->name }}" readonly class="form-control">
												{{-- <li>{{ $participant->name }}</li> --}}
											@endforeach
										{{-- </ul> --}}
									@else
										<a href="#" data-toggle="tooltip" title="{{ $booking->toCounselee->name }}">
											<img src="{{ is_null($booking->toCounselee) && is_null($booking->toCounselee->avatar) ? '/images/user.png' : asset('storage/'.$booking->toCounselee->avatar) }}" alt="{{ $booking->toCounselee->name }}" class="rounded-circle img-fluid ac-avatar" height="75" width="75">
										</a>
									@endif
								</div>
							</div>
						@endif

						@if(auth()->user()->hasRole('member'))
							<div class="form-group row">
								<label for="company" class="col-form-label col-sm-4 text-md-right">Psychologist</label>
								<div class="col-sm-6">
									<a href="#" data-toggle="tooltip" title="{{ $booking->toSchedule->psych->name }}">
										<img src="{{ is_null($booking->toSchedule->psych->avatar) ? '/images/user.png' : asset('storage/'.$booking->toSchedule->psych->avatar) }}" alt="{{ $booking->toSchedule->psych->name }}" class="rounded-circle img-fluid ac-avatar" height="75" width="75">
									</a>
								</div>
							</div>
						@endif

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
							@if($booking->status == 1)
								<div class="col-sm-6">

									
									<div class="input-group mb-3">
										<select name="status" class="form-control">
											<option value="" disabled selected>{{ $booking->toStatus->name }}</option>
											@foreach($session_statuses as $status)
												<option value="{{$status->id}}">{{ $status->name}}</option>
											@endforeach
										</select>
										<div class="input-group-append">
											<button class="btn btn-outline-primary">
												<i class="fa fa-check"></i>
											</button>
											<button class="btn btn-outline-secondary">
												<i class="fa fa-times"></i>
											</button>
										</div>
									</div>

										

									
								</div>
							@else
								<div class="col-sm-3">
									<input type="text" readonly value="{{ $booking->toStatus->name }}" class="form-control">
								</div>

								@if($booking->status == 4 && !is_null($booking->cancelled))
									<span class="mt-2">{{ $booking->cancelled->reasonOption->option_name }}</span>
								@endif

							@endif
						</div>

					</div>
				</div>
			</div>
			<!-- for users that has role of psychologist and for booking with the session type of individual / consultation -->


			<div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header">
						Message
					</div>

					<div class="card-body">
						
					</div>
				</div>
			</div>
			
			<!-- end for users that has role of psychologist and for booking with the session type of individual / consultation -->
		</div>
	</div>
@endsection