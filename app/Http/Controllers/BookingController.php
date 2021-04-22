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
        $this->time_lists = TimeList::get(['id', 'from', 'to']);
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

        return view('pages.bookings.create2', compact('categories', 'session_types'));
    }
    public function bookNow(Request $request)
    {
        // check if validation fails
        if($this->validateBooking($request->all())->fails()){

            return response()->json([
                'success' => false, 
                'data' => $this->validateBooking($request->all())->errors()->all()
            ]);
        }

        // find schedule by scheduled_date and psychologist
        $schedule = $this->findSchedule($request);

        // Begin Database Transaction
    	DB::beginTransaction();

    	try {


            if(!is_null($schedule))
            {
                // Store Booking
                $booking = Booking::create([

                    'schedule' => $schedule->id,
                    'time_id' => $request->time_id,
                    'counselee' => is_null($request->counselee) ? auth()->user()->id : $request->counselee,
                    'booked_by' => auth()->user()->id,
                    'session_type_id' => is_null($request->session_type_id) ? 1 : $request->session_type_id,
                    'status' => 1 // booked
                ]);

                // if booked
                if($booking){

                    // store onboarding answers
                    if($request->has('choice')){

                        $this->submitAnswers($booking->id, $request);

                    }

                    // store booking to progress reports if only
                    // when the session type selected is individual / consultation

                }

            }else{

                return response()->json(['success' => false, 'message' => 'Oops! No Schedule Found!']);
            }
    	} catch (Exception $e) {
    		
    		DB::rollback();

    		return response()->json(['success' => false, 'message' => $e->getMessage() ], 500);
    	}
        
    	DB::commit();

        return response()->json(['success' => true, 'message' => 'Successfully Booked a session'], 200);

    	// return redirect()->route('home')->with('success', 'You have successfully booked a session');
    }

    public function submitAnswers($booking_id, $request)
    {
        foreach($request->choice as $index => $value){

            if($value != null){

                AssessmentAnswer::create([
                    'booking_id' => $booking_id,
                    'category_id' => 1,
                    'questionnaire_id' => $index,
                    'answer' => $value
                ]);
            }
            
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
        return PsychologistSchedule::where('start', $request->scheduled_date)->where('psychologist', $request->psychologist)->first();
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
