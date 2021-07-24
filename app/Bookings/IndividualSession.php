<?php

namespace App\Bookings;

use App\Bookings\AbstractBooking;
use App\Booking;

class IndividualSession extends AbstractBooking{

	public function create()
	{
		return 'Individual Session';
	}
}