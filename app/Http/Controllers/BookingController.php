<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PsychologistSchedule;
use App\TimeList;

class BookingController extends Controller
{
    public function index()
    {
        $time_lists = TimeList::with(['schedules'])->get();

        return view('pages.bookings.index', compact('time_lists'));
    }
    public function bookNow(Request $request)
    {
    	DB::beginTransaction();

    	try {

    		PsychologistSchedule::where('start', $request->start_date)
    			->where('time', $request->time)
    			->where('psychologist', $request->psychologist)
    			->update(['book_with' => auth()->user()->id ]);
    		
    	} catch (Exception $e) {
    		
    		DB::rollback();

    		return redirect()->back()->with('error', $e->getMessage());
    	}


    	DB::commit();

    	return redirect()->back();
    }
}
