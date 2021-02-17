<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\PsychologistSchedule;

class SchedulesController extends Controller
{
    public function index()
    {
    	return view('pages.schedules.index');
    }

    /**
      * Returns a view for booking a schedule
      *

    */
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
        $start_date_time = $this->combineDT($request->start_date, $request->start_time);
        $end_date_time = $this->combineDT($request->end_date, $request->end_time);

        $schedule = PsychologistSchedule::firstOrCreate([

            'psychologist' => auth()->user()->id,
            'title' => $request->title,
            'start' => $start_date_time,
            'end' => $end_date_time,
            'allDay' => $request->has('allDay') ? true : false,
            'color' => $request->color,
            'textColor' => $request->textColor
        ]);

        return redirect()->back();
    }

    protected function combineDT($date, $time)
    {
        $new_date = new DateTime($date);
        $new_time = new DateTime($time);

        $new_date->setTime($new_time->format('H'), $new_time->format('i'), $new_time->format('s'));

        return $new_date->format('Y-m-d H:i:s');
    }
}
