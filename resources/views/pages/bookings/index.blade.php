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
	<tbody>
		@foreach($bookings as $booking)
			<tr>
				<td>{{ $booking->toSchedule->start }}</td>
				<td>
					{{ $booking->time->parseTimeFrom().' - '. $booking->time->parseTimeTo()}}
				</td>
				<td>{{ 
					auth()->user()->hasRole('psychologist') ?
					$booking->bookedBy->name :
					$booking->toSchedule->psych->name
				 }}</td>
				 <td><a href="{{ route('booking.answered.questions', $booking->id) }}">link to onboarding questions</a></td>
				 <td>
				 	<a href="#">idq032132kjdwq-23</a>
				 </td>
				 <td>
				 	<span class="{{ $booking->toStatus->class }}">
				 		{{ $booking->toStatus->name }} 
				 	</span><br />
				 	@if(!is_null($booking->reschedule))
				 		<a href="{{ route('booking.cancel', $booking->id) }}">see reason</a>
				 	@endif
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
							    <i class="fa fa-check"></i>
							    <span>Complete</span>
							</a>

							<a href="#" class="dropdown-item">
							    <i class="fa fa-eye"></i>
							    <span>No Show</span>
							</a>

							<a href="{{ route('booking.cancel', $booking->id) }}" class="dropdown-item">
							    <i class="fa fa-times"></i>
							    <span>Cancel</span>
							</a>
							<a href="{{ route('booking.reschedule', $booking->id) }}" class="dropdown-item">
							    <i class="fa fa-clock"></i>
							    <span>Reschedule</span>
							</a>
						</div>
					</div>
				 </td>
			</tr>
		@endforeach
	</tbody>
</table>