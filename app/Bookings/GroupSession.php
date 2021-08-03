<?php

namespace App\Bookings;

use App\Bookings\AbstractBooking;
use App\Bookings\BookingInterface;
use App\Booking;

class GroupSession extends AbstractBooking implements BookingInterface {

	public function create()
	{
		$booking = Booking::firstOrCreate([

			'room_id' => uniqid(),
			'schedule' => session('booking_details.schedule.id'),
			'time_id' => session('booking_details.timelist.id'),
			'client_id' => session('selected_client.id'),
			'booked_by' => auth()->user()->id,
			'session_type_id' => session('selected_session.id'),
			'status' => 1
		]);

		// must store also participants of the session
		foreach(session('participants') as $participant){
			$booking->participants()->attach($participant);
		}

		return $booking;
	}
}