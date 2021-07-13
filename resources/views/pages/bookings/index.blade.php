
	<ul class="nav nav-tabs mb-3">
			@foreach($booking_statuses as $booking_status)
			  	<li class="nav-item">
			    	<a class="nav-link {{ $booking_status['id'] == 1 ? 'active' : '' }}" href="#">
			    	{{ $booking_status['id'] == 1 ? 'Upcoming' : $booking_status['name']}}
			    	<span class="{{ $booking_status['class'] }}">{{ $booking_status['total'] }}</span>
			    	</a>
			    	
			  	</li>
	  		@endforeach
	</ul>
<table class="table">
	<thead>
		<tr>
			<th>DateTime</th>
			<th>Type</th>
			<th>Counselee</th>
			<th>Psychologist</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		
		@foreach($bookings as $booking)
			<tr>
				<td>{{ $booking->toSchedule->fullStartDate().' @ '.$booking->time->parseTimeFrom().' - '. $booking->time->parseTimeTo() }}
				</td>
				<td>{{ $booking->sessionType->name }}</td>
				<td>
					<a href="#" data-toggle="tooltip" title="{{ !is_null($booking->counselee) ? $booking->toCounselee->name: 'N/A' }}">
						<img src="{{ asset('images/profile.png') }}" class="rounded-circle" alt="{{ !is_null($booking->counselee) ? $booking->toCounselee->name: 'N/A' }}" height="50" width="50">
					</a>
				</td>
				 <td>
				 	<a href="#" data-toggle="tooltip" title="{{ $booking->toSchedule->psych->name }}">
						<img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="{{ $booking->toSchedule->psych->name }}" height="50" width="50">
					</a>
				 </td>
				 <td>

				 	<booking-status session-status="{{ $booking->toStatus->name }}" :booking-id="{{ $booking->id }}"></booking-status>

				 	{{-- <a href="#">{{ $booking->toStatus->name }}</a>
				 	<br />
				 	@if(!is_null($booking->reschedule))
				 		<a href="#" data-toggle="modal" data-target="#cancel-form">see reason</a>
				 		@include('pages.bookings.modals.cancel-form')
				 	@endif --}}
				 </td>
			</tr>
		@endforeach
	</tbody>
</table>
