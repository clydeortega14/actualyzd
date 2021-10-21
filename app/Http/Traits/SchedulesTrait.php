<?php

namespace App\Http\Traits;

use App\PsychologistSchedule;
use App\TimeList;
use DB;

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

        })->where('is_booked', false)
        ->with(["psych", "timeList"])
        ->get();

        return $schedules;
	}
    public function isGreaterThanCurretTime($schedule)
    {
        // find that time in timelists table where time is greater than or equal to current time
        return TimeList::where('from', '>=', now()->toTimeString())
            ->orwhere('to', '>=', now()->toTimeString())
            ->first();
    }

    public function scheduleTimeQuery(PsychologistSchedule $schedule){
        
        $time_schedules = $this->filterTimeDisp($schedule)->with(['toTime', 'toSchedule'])->get();

        $mapped_time_format = $time_schedules->map(function($time_schedule){

            return [

                'id' => $time_schedule->time,
                'from' => $time_schedule->toTime->parseTimeFrom(),
                'to' => $time_schedule->toTime->parseTimeTo()
            ];
        });

        return $mapped_time_format;
    }

    public function filterTimeDisp(PsychologistSchedule $schedule){


        $current_time = now()->addHour(1)->toTimeString();

        $time_lists = TimeList::whereTime('from', '>=', $current_time)->get();

        return $schedule->timeSchedules()->where(function($query) use ($time_lists, $schedule) {

            if($schedule->start == now()->toDateString()){

                $query->whereIn('time', $time_lists->pluck('id'));
            }

        })->where('is_booked', false);
    }

    public function pluckedAllTime(){

        $current_time = now()->addHour(1)->toTimeString();

        $time_lists = TimeList::whereTime('from', '>=', $current_time)->pluck('id');

        return $time_lists;
    }
}