<?php

namespace App\Bookings;
use App\Bookings\AbstractBooking;

class WebinarSession extends AbstractBooking{

	public function create()
	{
		return 'Webinar Session';
	}
}