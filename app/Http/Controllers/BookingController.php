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
use App\ProgressReport;
use App\TimeSchedule;
use App\FollowupSession;
use App\User;
use App\SessionParticipant;
use App\Client;

class BookingController extends Controller
{
    use BookingTrait;
    
    public function __construct()
    {
        $this->categories = AssessmentCategory::has('questionnaires')->with('questionnaires')->get(['id', 'name']);
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
        return view('pages.bookings.create2');
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

        // find schedule by schedule_id
        $schedule = PsychologistSchedule::findOrFail($request->schedule);

        // find time schedules by request schedule and time_id
        $time_schedule = TimeSchedule::where('schedule', $request->schedule)
            ->where('time', $request->time_id)->first();

        // Begin Database Transaction
    	DB::beginTransaction();

    	try {

            // Check if psychologist schedule and time schedule was found
            // and did not return null
            if(!is_null($schedule) && !is_null($time_schedule))
            {
                // Store Booking
                $booking = Booking::firstOrCreate([

                    'schedule' => $schedule->id,
                    'time_id' => $request->time_id,
                    'client_id' => is_null($request->client) ? auth()->user()->client->id : $request->client,
                    'booked_by' => auth()->user()->id,
                    'session_type_id' => is_null($request->session_type_id) ? 1 : $request->session_type_id,
                    'is_firstimer' => $request->is_firstimer,
                    'status' => 1 // booked
                ]);

                // if booked
                if($booking){

                    // update time schedule is_booked to true
                    $time_schedule->update(['is_booked' => true]);

                    // store onboarding answers
                    if($request->has('choice')){

                        // validate must required all fields

                        // submit on boarding question answers
                        $this->submitAnswers($booking->id, $request);
                    }

                    // store session participants
                    $this->manageParticipant($booking, $request);
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
    }

    /* For Participants Methods*/

    protected function clientAdmins($client)
    {
        $client = Client::findOrFail($client);

        return $client->users()->whereHas('roles', function($q){
            $q->where('name', 'admin');
        })->get();
    }

    public function manageParticipant($booking, $request)
    {
        if(is_null($request->counselee))
        {
            // when the're is no counselee / counselee is null
            // determine if the user who book the session has role member
            if(auth()->user()->hasRole('member')){

                // session participant must be member
                $this->storeParticipant($booking, auth()->user()->id);

            }else{ // if the user who booked the session is superadmin / admin

                // the first participant to be included in the session must be clients users with the role of admin
                foreach($this->clientAdmins($request->client) as $participant)
                {
                    // store participants
                    $this->storeParticipant($booking, $participant->id);
                }
            }
        }else{
            // if counselee is not null
            $this->storeParticipant($booking, $request->counselee);
        }
    }

    public function storeParticipant($booking, $participant)
    {
        return DB::table('session_participants')->insert(['booking_id' => $booking->id, 'participant' => $participant ]);
    }

    /*  End For Participants Methods */

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
        $followup_sessions = FollowupSession::get(['id', 'name']);
        return view('pages.bookings.answered-questions', compact('booking', 'categories', 'followup_sessions'));
    }

    public function updateToCancel(Booking $booking, Request $request)
    {
        //Update booking status to cancelled
        $booking->update(['status' => 4]);

        // store reason for cancelling in the database
        $reason = $this->storeReason($booking, $request);

        // update the schedule to available again
        $booking->toSchedule->update(['status' => 1 ]);

        return redirect()->back()->with('success', 'Session has been cancelled');
    }

    public function complete(Booking $booking)
    {
        // update booking status to complete
        $booking->update(['status' => 2 ]);

        if(!$booking){
            return redirect()->back()->with('error', 'There was an error during completing this session');
        }

        return redirect()->back()->with('success', 'Session has been completed');
    }

    public function noShow(Booking $booking)
    {
        // update status to no show
        $booking->update(['status' => 3 ]);

        if(!$booking){
            return redirect()->back()->with('error', 'Oops! There was an error');
        }

        return redirect()->back()->with('success', 'No Show!');
    }

    public function reschedule(Booking $booking)
    {
        // $time_lists = $this->time_lists;
        // $categories = $this->categories;

       $booking = $booking->with(['toSchedule'])->first();

        return view('pages.bookings.create2', compact('booking'));
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

    public function updateMainConcern(Booking $booking, Request $request)
    {
        $booking->update(['main_concern' => $request->booking_main_concern ]);

        return redirect()->back()->with('success', 'Updated main concern');
    }

    public function addLinkToSession(Booking $booking, Request $request)
    {
        $booking->update(['link_to_session' => $request->link_to_session ]);

        return redirect()->back()->with('success', 'Add Link to session');
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
