<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\PsychologistSchedule;
use App\TimeList;
use App\TimeSchedule;
use Carbon\CarbonPeriod;

class SchedulesController extends Controller
{
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
        $schedules = PsychologistSchedule::where(function($q){
            if($this->user()->hasRole('psychologist')){
                $q->where('psychologist', $this->user()->id);
            }
        })->whereDate('start', '>=', now()->toDateString())->get();

        return response()->json($schedules);

        // $collections = collect($schedules);
        // $unique = $collections->unique('start');
        // return response()->json($unique->values()->all());
    }
    public function storeSchedule(Request $request)
    {
        $period = CarbonPeriod::create($request->start_date, $request->end_date);
        $dates = [];
        // Iterate over the period
        foreach ($period as $date) {
            // assign formatted date on dates array
            $dates[] = $date->format('Y-m-d');
        }
        // remove the last element in order to get the correct date range
        array_pop($dates);

        // Delete all schedules related to current psychologist and the date in the calendar selected
        PsychologistSchedule::where('psychologist', $this->user()->id)->where('start', $request->start_date)->delete();

        // Check if there are selected time
        if($request->has('time_lists')){
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

        $time_schedules = TimeSchedule::where('schedule', $request->schedule)
            ->with(['toTime', 'toSchedule'])->get();

        return response()->json([
            'schedules' => $schedules, 
            'time_lists' => $time_lists,
            'time_schedules' => $time_schedules 
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
        $time_lists = PsychologistSchedule::where('start', $request->start)->with(['toTime'])->get();

        return view('pages.schedules.components.time-date', compact('time_lists'));
    }
}
