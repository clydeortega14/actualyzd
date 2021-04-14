<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PsychologistSchedule;
use App\TimeList;
use App\AssessmentCategory;
use App\AssessmentAnswer;
use App\Http\Requests\BookingRequest;
use App\Http\Traits\BookingTrait;
use App\Booking;
use App\RescheduledBooking;
use App\SessionType;

class BookingController extends Controller
{
    use BookingTrait;
    
    public function __construct()
    {
        $this->categories = AssessmentCategory::get(['id', 'name']);
        $this->time_lists = TimeList::with(['schedules'])->get();
        $this->session_types = SessionType::get(['id', 'name']);
    }
    public function index()
    {
        $bookings = $this->bookingsQuery();
        return view('pages.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $categories = $this->categories;
        $session_types = $this->session_types;

        return view('pages.bookings.create', compact('categories', 'session_types'));
    }
    public function bookNow(BookingRequest $request)
    {
        $validated = $request->validated();

        // find schedule
        $schedule = $this->findSchedule($request);

    	DB::beginTransaction();

    	try {

            if(!is_null($schedule)){

                 // store bookings
                $booking = Booking::create([

                    'schedule' => $schedule->id,
                    'booked_by' => auth()->user()->id,
                    'status' => 1
                ]);

                // update psychologist schedule to not available
                $schedule->update(['status' => 2]);

                // for assessment answered questions
                // store assessment answers to DB
                if($request->has('choice')){
                    $this->submitAnswers($booking->id, $request);
                }

            }else{

                return redirect()->back()->with('error', 'Cannot Find Schedule');
            }
    		
    	} catch (Exception $e) {
    		
    		DB::rollback();

    		return redirect()->back()->with('error', $e->getMessage());
    	}
        
    	DB::commit();

    	return redirect()->route('home')->with('success', 'You have successfully booked a session');
    }

    public function submitAnswers($booking_id, $request)
    {
        foreach($request->choice as $index => $value){

            AssessmentAnswer::create([
                'booking_id' => $booking_id,
                'category_id' => 1,
                'questionnaire_id' => $index,
                'answer' => $value
            ]);

        }
    }
    public function getAssessment(Booking $booking)
    {
        $categories = $this->categories;

        return view('pages.bookings.answered-questions', compact('booking', 'categories'));
    }

    public function cancel(Booking $booking)
    {
        return view('pages.bookings.cancel', compact('booking'));
    }

    public function updateToCancel(Booking $booking, Request $request)
    {
        //Update booking status to cancelled
        $booking->update(['status' => 5]);

        // store reason for cancelling in the database
        $reason = $this->storeReason($booking, $request);

        // update the schedule to available again
        $booking->toSchedule->update(['status' => 1 ]);

        return redirect()->route('member.home')->with('success', 'Session has been cancelled');

    }

    public function reschedule(Booking $booking)
    {
        $time_lists = $this->time_lists;
        $categories = $this->categories;

        return view('pages.bookings.reschedule', compact('booking', 'time_lists', 'categories'));
    }
    public function reschedBooking(Booking $booking, Request $request)
    {
        // Find Schedule first based on newly selected schedule
        $schedule = $this->findSchedule($request);

        if(!is_null($schedule)){

            // on the psychologist schedule side, update status to available
            $booking->toSchedule->update(['status' => 1]);

            // update booking id based on new schedule id
            // also update status to rescheduled, 
            $booking->update(['schedule' => $schedule->id, 'status' => 6]);

            // store the reason for rescheduling the session in the reschedule bookings
            $resched_reason = $this->storeReason($booking, $request);


            // after updating booking schedule, the newly selected schedule status
            // must be changed to not available or 2
            $schedule->update(['status' => 2]);


            return redirect()->back()->with('success', 'Booking rescheduled');

        }

        // return error message if schedule was not found
        return redirect()->back()->with('error', 'Schedule that has been selected was not found!');
    }

    protected function findSchedule($request)
    {
        return PsychologistSchedule::where('start', $request->start_date)
                    ->where('time', $request->time)
                    ->where('psychologist', $request->psychologist)
                    ->first();
    }

    protected function storeReason($booking, $request)
    {
        return RescheduledBooking::create([
            'booking_id' => $booking->id, 
            'updated_by' => auth()->user()->id, 
            'reason' => $request->reason 
        ]);
    }
}
