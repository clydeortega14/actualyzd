<?php

namespace App\Http\Traits;
use App\Booking;
use App\PsychologistSchedule;
trait BookingSchedulesTrait {

	public function getArrscheduleID()
	{
		return Booking::pluck('schedule');
	}

	public function pluckedMonthSchedules($month)
	{
		return $this->schedulesByMonth($month)->pluck('id');
	}

	public function schedulesByMonth($month)
	{
		return $this->schedulesWithBookingScheds()->whereMonth('start', $month);
	}

	public function pluckedYearSchedules($year)
	{
		return $this->schedulesByYear($year)->pluck('id');
	}

	public function schedulesByYear($year)
	{
		return $this->schedulesWithBookingScheds()->whereYear('start', $year);
	}

	public function schedulesWithBookingScheds()
	{
		return PsychologistSchedule::whereIn('id', $this->getArrscheduleID());
	}
}