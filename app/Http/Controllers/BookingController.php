<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PsychologistSchedule;
use App\TimeList;
use App\AssessmentCategory;
use App\AssessmentAnswer;
use App\Http\Requests\BookingRequest;
use App\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::get();

        return view('pages.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $time_lists = TimeList::with(['schedules'])->get();
        $categories = AssessmentCategory::get(['id', 'name']);

        return view('pages.bookings.create', compact('time_lists', 'categories'));
    }
    public function bookNow(BookingRequest $request)
    {
        $validated = $request->validated();

        $schedule = PsychologistSchedule::where('start', $request->start_date)
                    ->where('time', $request->time)
                    ->where('psychologist', $request->psychologist)
                    ->first();

    	DB::beginTransaction();

    	try {

            if(!is_null($schedule)){

                 // store bookings
                $booking = Booking::create([

                    'schedule' => $schedule->id,
                    'booked_by' => auth()->user()->id,
                    'status' => 1,
                    'category_id' => $request->category
                ]);

                // update psychologist schedule to not available
                $schedule->update(['status' => 2]);

                // for assessment answered questions
                // store assessment answers to DB
                $this->submitAnswers($booking->id, $request);
            }else{

                return redirect()->back()->with('error', 'Cannot Find Schedule');
            }
    		
    	} catch (Exception $e) {
    		
    		DB::rollback();

    		return redirect()->back()->with('error', $e->getMessage());
    	}


    	DB::commit();

    	return redirect()->route('bookings.index')->with('success', 'You have successfully booked a session');
    }

    public function submitAnswers($booking_id, $request)
    {
        foreach($request->choice as $index => $value){

                AssessmentAnswer::create([
                        'booking_id' => $booking_id,
                        'questionnaire_id' => $index,
                        'answer' => $value
                ]);

        }
    }
}
