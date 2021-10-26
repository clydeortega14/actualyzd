<?php

namespace App\Bookings;
use App\Http\Traits\BookingSchedulesTrait;
use App\Booking;
use Mail;
use App\Mail\PastDueBooking;

class PastDue {

	use BookingSchedulesTrait;


	public function bookings(){

		$plucked_pastdue_schedule_id = $this->pastDueSchedules()->whereMonth('start', date('m'))->pluck('id');

		$past_due_bookings = Booking::whereIn('schedule', $plucked_pastdue_schedule_id)->get();

		$this->loopSendEmail($past_due_bookings);
	}

	protected function loopSendEmail($past_due_bookings){

		$psychologists = [];

		foreach($past_due_bookings as $past_due){

			Mail::to($past_due->toSchedule->psych)->send(new PastDueBooking($past_due));
		}

	}


}