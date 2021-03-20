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
										<th>Booking With</th>
										<th>Schedule</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($bookings as $booking)
										<tr>
											<td>
												<img src="{{ asset('sb-admin/img/undraw_profile.svg') }}" class="rounded-circle text-center" alt="{{ $booking->toSchedule->psych->name }}" width="60" height="60" data-toggle="tooltip" title="{{ $booking->toSchedule->psych->name }}">
											</td>
											<td>
												<a href="#">{{ $booking->toCategory->name }}</a> <br />
												{{ date('F j, Y', strtotime($booking->toSchedule->start )) }} <br />
												<span class="{{ $booking->toStatus->class }}">
													{{ $booking->toSchedule->toTime->parseTimeFrom().' - '. $booking->toSchedule->toTime->parseTimeTo() }}
												</span>
											</td>
											<td>
												<span class="{{ $booking->toStatus->class }}">
													{{ $booking->toStatus->name}}
												</span>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop