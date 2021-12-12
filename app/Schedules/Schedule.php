<?php


namespace App\Schedules;
use App\PsychologistSchedule;


class Schedule
{

	public function query($user)
	{
		$schedules = PsychologistSchedule::query();

		if($user->hasRole('psychologist'))
		{
			// query by user
			$schedules->where('psychologist', $user->id);
		}

		$schedules->whereDate('start', '>=', now()->toDateString())->orderBy('start', 'asc');

		return $schedules;
	}
}