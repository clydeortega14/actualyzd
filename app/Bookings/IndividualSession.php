<?php

namespace App\Bookings;

use App\Bookings\AbstractBooking;
use App\Booking;
use App\Bookings\BookingInterface;
use App\Http\Traits\BookingTrait;

class IndividualSession extends AbstractBooking implements BookingInterface {

	use BookingTrait;

	public function create()
	{
		 $booking = Booking::create([

            'room_id' => uniqid(),
            'schedule' => session('booking_details.schedule.id'),
            'time_id' => session('booking_details.timelist.id'),
            'client_id' => auth()->user()->client_id,
            'booked_by' => auth()->user()->id,
            'counselee' => auth()->user()->id,
            'session_type_id' => 1,
            'self_harm' => session('assessment.self_harm'),
            'is_firstimer' => session('assessment.is_firsttimer'),
            'status' => 1
        ]);

        if(session()->has('assessment.onboarding_answers')){
        	$this->submitAnswers($booking->id, session('assessment.onboarding_answers'));
        }
	}
}