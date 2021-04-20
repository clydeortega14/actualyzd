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
        })->whereDate('start', '>=', now()->toDateString())->get();

        // map collections with unique start date
        $unique = collect($schedules)->unique('start')->map(function($item, $key){

            return [

                'id' => $item->id,
                'start' => $item->start,
                'end' => $item->end,
                'display' => 'background',
                'color' => 'green'

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

    public function psychologists(Request $request)
    {
        $psychologists = PsychologistSchedule::where('start', $request->start)
            ->where('time', $request->time)
            ->where('status', 1)
            ->with(['toTime', 'status', 'psych'])
            ->get();

        return view('pages.schedules.components.psychologist', compact('psychologists'));
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

    public function timeDate(Request $request)
    {
        $time_lists = PsychologistSchedule::where('start', $request->start)
            ->where('status', 1)
            ->with(['toTime'])
            ->orderBy('start', 'ASC')
            ->get();

        return view('pages.schedules.components.time-date', compact('time_lists'));
    }
}
