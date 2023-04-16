<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PsychologistSchedule;
use App\TimeList;
use App\AssessmentCategory;
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
use App\Events\BookingActivity;
use App\ReasonOption;
use App\CancelledBooking;
use App\BookingStatus;

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
        return view('pages.superadmin.bookings.index');
    }

    public function create()
    {
        $categories = $this->categories;
        return view('pages.bookings.create2', compact('categories'));
    }
    public function cancel(Booking $booking)
    {
        $reason_options = ReasonOption::get();

        return view('pages.bookings.cancel', compact('booking', 'reason_options'));
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
                    'client_id' => is_null($request->client) ? auth()->user()->client_id : $request->client,
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
                    if($request->has('onboarding_answers')){

                        // validate must required all fields

                        // submit on boarding question answers
                        $this->submitAnswers($booking->id, $request->onboarding_answers);
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

        event(new BookingActivity);

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

    public function getAssessment($room_id)
    {
        $booking = Booking::where('room_id', $room_id)->first();
        $categories = $this->categories;
        $followup_sessions = FollowupSession::get(['id', 'name']);
        $session_statuses = BookingStatus::where(function($query){

            $user = auth()->user();
            if($user->hasRole('psychologist')){
                $query->whereIn('id', [2,3,4,5]);
            }

            if($user->hasRole('member')){
                $query->whereIn('id', [4]);
            }

        })->get(['id', 'name']);

        return view('pages.bookings.answered-questions', compact(
            'booking', 
            'categories', 
            'followup_sessions', 
            'session_statuses'
        ));
    }

    public function updateToCancel(Booking $booking, Request $request)
    {
        // validate reason must be required
        $request->validate([

            'reason' => ['required_without_all'] 
        ]);

        // if reason is others, must specify other reason why he /she cancel the booking
        if($request->reason == 5){

            $request->validate([

                'others_specify' => ['required']
            ]);
        }

        //Update booking status to cancelled
        $booking->update(['status' => 4]);

        // store reason for cancelling in the database
        $cancelled_booking = CancelledBooking::create([

            'booking_id' => $booking->id,
            'cancelled_by' => auth()->user()->id,
            'reason_option_id' => $request->reason

        ] + ['others_specify' => $request->has('others_specify') ? $request->others_specify : null]);

        // update the time schedule to available again
        $booking->toSchedule->timeSchedules()->where('time', $booking->time_id)->update(['is_booked' => false]);

        return redirect()->route('home')->with('success', 'Session has been cancelled');
    }
    public function reschedBooking(Booking $booking, Request $request)
    {
        $booking->update(['status' => 5]);

         // store reason for cancelling in the database
        $reason = $this->storeReason($booking, $request);
        
        return redirect()->route('home')->with('success', 'Session has been cancelled');
        
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


    // public function complete(Booking $booking)
    // {
    //     // update booking status to complete
    //     $booking->update(['status' => 2 ]);

    //     if(!$booking){
    //         return redirect()->back()->with('error', 'There was an error during completing this session');
    //     }

    //     return redirect()->back()->with('success', 'Session has been completed');
    // }

    // public function noShow(Booking $booking)
    // {
    //     // update status to no show
    //     $booking->update(['status' => 3 ]);

    //     if(!$booking){
    //         return redirect()->back()->with('error', 'Oops! There was an error');
    //     }

    //     return redirect()->back()->with('success', 'No Show!');
    // }

    public function reschedule(Booking $booking)
    {

        $booking->load([
            'toSchedule.psych', 
            'time',
            'sessionType',
            'toStatus',
            'reschedule',
            'cancelled.reasonOption'

       ]);

        return view('pages.bookings.reschedule', compact('booking'));
    }
}
