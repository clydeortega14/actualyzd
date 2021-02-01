<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
