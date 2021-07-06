<?php

namespace App\Http\Traits;

use App\PsychologistSchedule;

trait SchedulesTrait {


	public function schedulesQuery()
	{
		// schedules query
        $schedules = PsychologistSchedule::where(function($q){

            if(auth()->user()->hasRole('psychologist')){
                $q->where('psychologist', auth()->user()->id);
            }
        })->whereDate('start', '>=', now()->toDateString())
        ->with(["psych"])->get();

        return $schedules;
	}
}