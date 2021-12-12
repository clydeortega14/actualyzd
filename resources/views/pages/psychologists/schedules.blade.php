@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">

				<h3 class="text-gray-800 mb-3">Manage Schedules</h3>

				<div class="card">
					<div class="card-header">
						<a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#add-schedule">
							<i class="fa fa-plus-circle"></i>
							<span>Add Schedule</span>
						</a>

						@include('pages.psychologists.modals.add-schedule')
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Date</th>
										<th>Time</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($schedules as $schedule)

										<tr>
											<td>{{ $schedule->start }}</td>
											<td>{{ $schedule->timeList->parseTimeFrom().' - '.$schedule->timeList->parseTimeTo()}}</td>
											<td>
												<span class="badge {{ $schedule->is_booked ? 'badge-success' : 'badge-secondary' }}">
													{{ $schedule->is_booked ? 'Booked' : 'Available' }}
												</span>
											</td>
											<td>
												@if($schedule->is_booked)
													<a href="#" class="btn btn-primary btn-sm" data-toggle="tooltip" title="View Session">
														<i class="fa fa-eye"></i>
													</a> |
												@endif
												<a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip" title="View Session" {{ !$schedule->is_booked ? 'disabled' : ''  }}>
													<i class="fa fa-trash"></i>
												</a>
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