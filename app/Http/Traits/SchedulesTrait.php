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

        })->where(function($query){

            if(request()->session()->exists('assessment.self_harm')){

                $self_harm = session('assessment.self_harm');

                if(!$self_harm){

                    // must display schedules 24 hours before
                    $start = now()->addHours(24);

                    $query->whereDate('start', '>=', $start);

                }else{

                    $query->whereDate('start', '>=', now()->toDateString());
                }

            }else{

                $query->whereDate('start', '>=', now()->toDateString());
            }

        })->with(["psych"])->get();

        return $schedules;
	}
}