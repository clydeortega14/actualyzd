<table class="table">
	<thead>
		<tr>
			<th>Date</th>
			<th>Time</th>
			<th>Client Details</th>
			<th>Company</th>
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($bookings as $booking)
			<tr>
				<td>{{ date('m/d/Y', strtotime($booking->toSchedule->start)) }}</td>
				<td>
					{{ $booking->time->parseTimeFrom().' - '. $booking->time->parseTimeTo()}}
				</td>
				<td>{{ $booking->toCounselee->name}}</td>
				 <td>
				 	<a href="#">Company A</a>
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
				 <td>
				 	<a href="{{ route('booking.answered.questions', $booking->id) }}" class="btn btn-info btn-sm">
				 		actions
				 	</a>
				 </td>
			</tr>
		@endforeach
	</tbody>
</table>