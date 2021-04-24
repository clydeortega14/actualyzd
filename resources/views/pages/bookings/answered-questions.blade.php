@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				{{ Breadcrumbs::render('booking.answered.questions', $booking) }}
			</div>

			<div class="col-md-8">
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
								<span>Counselee: <strong> {{ $booking->toCounselee->name }}</strong></span>
							</div>
							<div class="mb-3">
								<span>Psychologist: <strong> {{ $booking->toSchedule->psych->name}}</strong></span>
							</div>
							<div class="mb-3">
								<span>Type of session: <strong> {{ $booking->sessionType->name }} </strong></span>
							</div>
							<div class="mb-3">
								<span>Date: <strong> {{ $booking->toSchedule->start }} </strong></span>
							</div>

							<div class="mb-3">
								<span>Time: <strong> {{ $booking->time->parseTimeFrom().' - '.$booking->time->parseTimeTo()}} </strong></span>
							</div>

							<div class="mb-3">
								<span>Status: <span class="{{ $booking->toStatus->class }}"> {{ $booking->toStatus->name }} </span></span>
							</div>
						</div>
					</div>
				</div>

				<div class="card mb-3">
					<div class="card-header">Actions</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6 mb-2">
								<a href="#">Complete</a>
							</div>
							<div class="col-md-6 mb-2">
								<a href="#">No Show</a>
							</div>
							<div class="col-md-6 mb-2">
								<a href="#">Reschedule</a>
							</div>
							<div class="col-md-6 mb-2">
								<a href="#">Cancel</a>
							</div>
						</div>
					</div>
				</div>
			</div>
				
		</div>
	</div>
@endsection