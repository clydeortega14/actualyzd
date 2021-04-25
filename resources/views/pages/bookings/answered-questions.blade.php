@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('alerts.message')
				{{ Breadcrumbs::render('booking.answered.questions', $booking) }}
			</div>

			<div class="col-sm-2">
				<div class="card mb-3">
					<div class="card-header">Actions</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">

								@if($booking->status == 1) <!-- If booking status is booked -->
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
									<div class="mb-3">
										<a href="#" data-toggle="modal" data-target="#cancel-form">Cancel</a>
										<!-- Reason for canceling modal -->
										@include('pages.bookings.modals.cancel-form')
										<!-- end reason for canceling modal -->
									</div>
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
					<div class="card-header">
						Onboarding Questions & Answers
					</div>
					<div class="card-body">
						<ol type="I">
							@foreach($categories as $category)
								@if(count($category->questionnaires) > 0)
                                    <li>
                                    	<div class="mb-3">
                                    		<h5><b>{{ $category->name }}</b></h5>
                                    	</div>
                                    	@include('pages.bookings.components.questionnaire')
                                    </li>
								@endif
							@endforeach
						</ol>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header">
						Session Details
					</div>
					<div class="card-body">
						<div class="ml-2">
							<div class="mb-3">
								<strong>Company:</strong>
								<span> N/A</span> 
							</div>
							<div class="mb-3">
								<strong>Counselee:</strong>
								<span><a href="#"> {{ $booking->toCounselee->name }}</a></span> 
							</div>
							<div class="mb-3">
								<strong>Psychologist:</strong> <a href="#"> {{ $booking->toSchedule->psych->name}}</a>
							</div>
							<div class="mb-3">
								<strong>Type of session: </strong> </span>{{ $booking->sessionType->name }} </span>
							</div>
							<div class="mb-3">
								<strong>Date: </strong> {{ date('F j, Y', strtotime($booking->toSchedule->start)) }} </strong></strong>
							</div>

							<div class="mb-3">
								<strong>Time: </strong> 
								<span>{{ $booking->time->parseTimeFrom().' - '.$booking->time->parseTimeTo()}} </span>
							</div>

							<div class="mb-3">
								<strong>Link To Session: </strong> 
								<span><a href="#">http://meet.actualyzd.com/139213819321......</a></span>
							</div>

							<div class="mb-3">
								<strong>Status: </strong>
								<span class="{{ $booking->toStatus->class }}"> {{ $booking->toStatus->name }} </span>
							</div>
						</div>
					</div>
				</div>
			</div>
				
		</div>
	</div>
@endsection