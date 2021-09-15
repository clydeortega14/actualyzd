@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-body">
						<div clas="d-flex align-items-center">
						<h1 class="card-title text-center align-items-center">
							Main Menu
						</h1>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<a href="{{ route('psychologist.schedules.page') }}">
				    <div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Schedules</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-calendar-check"></i>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-4">
				<a href="{{ route('psychologist.bookings') }}">
				    <div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Bookings</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-book"></i>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-4">
				<a href="{{ route('progress.report') }}">
				    <div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Progress Reports</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-clipboard-list"></i>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>

			@if(count($unclosed_bookings) > 0)
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-body">
						<h5 class="card-title text-danger"><b>WARNING:</b> <small> You have past due sessions / bookings that has not been closed. please close it immediately</small></h5>

						<div class="table-responsive mt-3">
							<table class="table">
								<thead>
									<tr>
										<th>DateTime</th>
										<th>Type</th>
										<th>Counselee</th>
										<th>Link to progress report</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($unclosed_bookings as $uc_b)
									<tr>
										<td>
											<b>Date: </b><span>{{ $uc_b->toSchedule->fullStartDate()  }}</span> <br>
											<b>Time: </b><span>{{ $uc_b->time->parseTimeFrom().' - '.$uc_b->time->parseTimeTo() }}</span>
										</td>
										<td>{{ $uc_b->sessionType->name }}</td>
										<td>
											<a href="#">
												<img src="{{ is_null($uc_b->counselee) ? 'images/user.png' : asset($uc_b->toCounselee->avatar) }}" 
												     alt="{{ is_null($uc_b->counselee) ? 'N/A' : $uc_b->toCounselee->name }}" 
												     width="50" 
												     height="50" 
												     data-toggle="tooltip" 
												     title="{{ is_null($uc_b->counselee) ? 'N/A' : $uc_b->toCounselee->name }}"
												     class="rounded-circle">
											</a>
										</td>
										<td>N/A</td>
										<td>
											
											<booking-status 
												session-status="{{ $uc_b->toStatus->name }}" 
												:booking-id="{{ $uc_b->id}}" 
												:booking-status="{{ $uc_b->toStatus->id}}" ></booking-status>
											
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>

@endsection