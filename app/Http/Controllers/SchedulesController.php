<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\PsychologistSchedule;
use App\TimeList;
use App\TimeSchedule;
use App\Http\Traits\CarbonTrait;

class SchedulesController extends Controller
{
    use CarbonTrait;

    public function index()
    {   
    	return view('pages.schedules.index');
    }
    public function show()
    {
        return view('pages.schedules.show');
    }
    public function getSchedules()
    {
        // chedules query
        $schedules = PsychologistSchedule::where(function($q){

            if($this->user()->hasRole('psychologist')){
                $q->where('psychologist', $this->user()->id);
            }
        })->whereDate('start', '>=', now()->toDateString())
        ->with(["psych"])->get();

        // map collections with unique start date
        $unique = collect($schedules)->map(function($item, $key){

            return [
                'id' => $item->id,
                'title' => $item->psych->name,
                'psychologist' => $item->psych,
                'start' => $item->start,
                'end' => $item->end,
                'allDay' => true
            ];
        });
        
        return response()->json($unique);
    }
    public function storeSchedule(Request $request)
    {
        $dates = $this->betweenDates($request->start_date, $request->end_date);

        // Delete all schedules related to current psychologist and the date in the calendar selected
        PsychologistSchedule::where('psychologist', $this->user()->id)->where('start', $request->start_date)->delete();

        // Check if there are selected time
        if($request->has('time_lists')){
            // loop time lists array
            foreach($dates as $d){
                // Create schedule
                $schedule = PsychologistSchedule::firstOrCreate([
                    'psychologist' => auth()->user()->id,
                    'start' => $d,
                    'end' => $d
                ]);
                // loop time lists array
                foreach($request->time_lists as $key => $time)
                {
                    // store time schedules
                    TimeSchedule::firstOrCreate([
                        'schedule' => $schedule->id,
                        'time' => $time
                    ]);
                }
            }
        }
        
        return redirect()->back();
    }

    public function timeSchedule(Request $request)
    {
        // GET User schedule according to date selected
        $schedules = PsychologistSchedule::where('psychologist', $this->user()->id)
            ->where('start', $request->start)
            ->with(['timeSchedules', 'psych'])
            ->first();

        $time_lists = TimeList::get();

        return response()->json([
            'schedules' => $schedules, 
            'time_lists' => $time_lists,
        ]);
    }

    public function psychologists($time)
    {
        $time_schedules = TimeSchedule::where('time', $time)->with(['toSchedule.psych'])->get();

        $mapped_psychologists = $time_schedules->map(function($time_schedule){

            return [

                'id' => $time_schedule->toSchedule->psych->id,
                'name' => $time_schedule->toSchedule->psych->name
            ];

        })->unique('id')->values();

        return response()->json($mapped_psychologists);
    }

    public function delete(Request $request)
    {
        PsychologistSchedule::where('id', $request->sched_id)->delete();

        return redirect()->back();
    }
    public function user()
    {
        return auth()->user();
    }

    public function getTimeBySchedule(PsychologistSchedule $schedule)
    {
        $time_schedules = $schedule->timeSchedules()->with(['toTime', 'toSchedule'])->get();

        $mapped_time_format = $time_schedules->map(function($time_schedule){

            return [

                'id' => $time_schedule->time,
                'from' => $time_schedule->toTime->parseTimeFrom(),
                'to' => $time_schedule->toTime->parseTimeTo()
            ];
        });

        return response()->json($mapped_time_format);
    }
}
