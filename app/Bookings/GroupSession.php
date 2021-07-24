<?php

namespace App\Bookings;

use App\Bookings\AbstractBooking;

class GroupSession implements AbstractBooking {

	public function create()
	{
		return 'Group Session';
	}
}