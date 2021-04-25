<table class="table">
	<thead>
		<tr>
			<th>Date</th>
			<th>Time</th>
			<th>Client Details</th>
			<th>Topic</th>
			<th>Link of session</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach($bookings as $booking)
			<tr>
				<td>{{ date('m/d/Y', strtotime($booking->toSchedule->start)) }}</td>
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
				 		<a href="#" data-toggle="modal" data-target="#cancel-form">see reason</a>
				 		@include('pages.bookings.modals.cancel-form')
				 	@endif
				 </td>
			</tr>
		@endforeach
	</tbody>
</table>