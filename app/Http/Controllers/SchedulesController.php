<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\PsychologistSchedule;
use App\TimeList;

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

        $collections = collect($schedules);
        $unique = $collections->unique('start');
        return response()->json($unique->values()->all());
    }
    public function storeSchedule(Request $request)
    {
        // Delete all schedules related to current psychologist and the date in the calendar selected
        PsychologistSchedule::where('psychologist', $this->user()->id)->where('start', $request->start_date)->delete();

        // Check if there are selected time
        if($request->has('time_lists')){
            // loop time lists array
            foreach($request->time_lists as $time)
            {
                // Create schedule
                PsychologistSchedule::firstOrCreate([
                    'psychologist' => auth()->user()->id,
                    'start' => $request->start_date,
                    'end' => $request->start_date,
                    'time' => $time,
                    'status' => 1
                ]);
            }
        }
        
        return redirect()->back();
    }

    public function timeSchedule(Request $request)
    {
        // GET User schedule according to date selected
        $schedules = PsychologistSchedule::where('psychologist', $this->user()->id)
            ->where('start', $request->start)
            ->with(['toTime', 'status', 'bookWith'])
            ->get();

        $time_lists = TimeList::get();

        return response()->json(['schedules' => $schedules, 'time_lists' => $time_lists ]);


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
}
