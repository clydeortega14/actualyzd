<table class="table table-bordered">
	<thead>
		<tr>
			<th>Date</th>
			<th>Time</th>
			<th>Client Details</th>
			<th>Topic</th>
			<th>Link of session</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="bookings-table">
		@foreach($bookings as $booking)
			<tr>
				<td>{{ $booking->toSchedule->start }}</td>
				<td>
					{{ $booking->toSchedule->toTime->parseTimeFrom().' - '. $booking->toSchedule->toTime->parseTimeTo()}}
				</td>
				<td>{{ 
					auth()->user()->hasRole('psychologist') ?
					$booking->bookedBy->name :
					$booking->toSchedule->psych->name
				 }}</td>
				 <td><a href="#">link to onboarding questions</a></td>
				 <td>
				 	<a href="#">idq032132kjdwq-23</a>
				 </td>
				 <td>
				 	<span class="{{ $booking->toStatus->class }}">{{ $booking->toStatus->name }}</span>
				 </td>
				 <td>
				 	<div class="btn-group">
						<button type="button" class="btn btn-info btn-sm ">Action</button>
						<button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="sr-only"></span>
						</button>

						<div class="dropdown-menu">
							<a href="#" class="dropdown-item">
							    <i class="fa fa-edit"></i>
							    <span>Edit</span>
							</a>
							<a href="#" class="dropdown-item">
							    <i class="fa fa-times"></i>
							    <span>Cancel</span>
							</a>
							<a href="#" class="dropdown-item">
							    <i class="fa fa-clock"></i>
							    <span>Reschedule</span>
							</a>
							<a href="#" class="dropdown-item">
							    <i class="fa fa-clock"></i>
							    <span>Review</span>
							</a>
						</div>
					</div>
				 </td>
			</tr>
		@endforeach
	</tbody>
</table>


{{-- 

@extends('layouts.sb-admin.master')

@section('content')
	

	<div class="container-fluid">
		<div class="row">

			<h1 class="h3 mb-3 text-gray-800">Bookings</h1>

			<div class="col-sm-12">
				@include('alerts.message')
				<div class="card mb-3">
					<div class="card-header">
						<a href="{{ route('bookings.create') }}" class="btn btn-info btn-sm float-right">
							<i class="fa fa-plus"></i>
							<span>Book Session</span>
						</a>
					</div>
					<div class="card-body">
						<div class="table-resposive">
							<table class="table">
								<thead>
									<tr>
										<th>Date</th>
										<th>Time</th>
										<th>Description</th>
										<th>Assessment</th>
										<th>Status</th>
										<th>Link</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($bookings as $booking)
										<tr>
											<td>
												{{ date('F j, Y', strtotime($booking->toSchedule->start )) }}
											</td>
											<td>
												{{ $booking->toSchedule->toTime->parseTimeFrom().' - '. $booking->toSchedule->toTime->parseTimeTo() }}
											</td>
											<td>{{ $booking->bookedBy->name }} has session with {{ $booking->toSchedule->psych->name }}</td>
											<td><a href="{{ route('booking.answered.questions', $booking->id) }}">see assessment</a></td>
											<td>
												<span class="{{ $booking->toStatus->class }}">
													{{ $booking->toStatus->name}}
												</span>	
											</td>
											<td><a href="#">see link</a></td>
											<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info btn-sm ">Action</button>
													<button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<span class="sr-only"></span>
													</button>

													<div class="dropdown-menu">
														<a href="#" class="dropdown-item">
														    <i class="fa fa-edit"></i>
														    <span>Edit</span>
														</a>
														<a href="#" class="dropdown-item">
														    <i class="fa fa-times"></i>
														    <span>Cancel</span>
														</a>
														<a href="#" class="dropdown-item">
														    <i class="fa fa-clock"></i>
														    <span>Reschedule</span>
														</a>
														<a href="#" class="dropdown-item">
														    <i class="fa fa-clock"></i>
														    <span>Review</span>
														</a>
													</div>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop --}}