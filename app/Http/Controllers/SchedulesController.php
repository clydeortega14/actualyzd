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
        $time_lists = TimeList::all();
        
    	return view('pages.schedules.index', compact('time_lists'));
    }
    
    public function bookSchedule()
    {
    	return view('pages.schedules.book-now');
    }

    public function show()
    {
        return view('pages.schedules.show');
    }
    public function getSchedules()
    {
        $schedules = PsychologistSchedule::where('psychologist', auth()->user()->id)->get();

        return response()->json($schedules);
    }
    public function storeSchedule(Request $request)
    {

        foreach($request->time_lists as $time)
        {
            PsychologistSchedule::create([
                'psychologist' => auth()->user()->id,
                'start' => $request->start_date,
                'end' => $request->start_date,
                'time' => $time
            ]);
        }
        // is_null($request->sched_id) || $request->sched_id == "" ?

        //     $this->create($request) : 

        //     $this->update($request);
        
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        PsychologistSchedule::where('id', $request->sched_id)->delete();

        return redirect()->back();
    }
    protected function create(Request $request)
    {
        return PsychologistSchedule::firstOrCreate($this->data($request) + ['psychologist' => auth()->user()->id ]);
    }

    protected function update(Request $request)
    {
        return PsychologistSchedule::where('id', $request->sched_id)->update($this->data($request));
    }

    protected function data(Request $request)
    {
        $start_date_time = $this->combineDT($request->start_date, $request->start_time);
        $end_date_time = $this->combineDT($request->end_date, $request->end_time);

        return [

            'title' => $request->title,
            'start' => $start_date_time,
            'end' => $end_date_time,
            'allDay' => $request->has('allDay') ? true : false,
        ];
    }

    protected function combineDT($date, $time)
    {
        $new_date = new DateTime($date);
        $new_time = new DateTime($time);

        $new_date->setTime($new_time->format('H'), $new_time->format('i'), $new_time->format('s'));

        return $new_date->format('Y-m-d H:i:s');
    }
}
