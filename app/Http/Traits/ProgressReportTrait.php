<?php

namespace App\Http\Traits;

use App\ProgressReport;
use App\Booking;

trait ProgressReportTrait {

	public function getReports()
	{
		$user = auth()->user();

		$reports = ProgressReport::query();

		if($user->hasRole('psychologist')){

			// get all psychologist schedules
			$user_schedules = $user->schedules->pluck('id');

			// get all bookings based on user bookings
			$user_bookings = Booking::whereIn('id', $user_schedules)->pluck('id');

			$reports->whereIn('booking_id', $user_bookings);
		}


		return $reports->get();
	}
}