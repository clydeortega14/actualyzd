<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssessmentCategory;
use App\Http\Traits\SchedulesTrait;
use App\TimeList;
use App\PsychologistSchedule;
use DB;
use App\Booking;
use App\Http\Traits\BookingTrait;
use App\Http\Traits\BookingProcess\BookingProcessTrait;
use App\SessionType;
use App\Client;
use App\ClientSubscription;
use App\Http\Services\ClientSubscriptionService;
use App\Http\Services\SessionTypeService;
use App\User;
use App\Bookings\BookingInterface;
use App\TimeSchedule;
use App\BookingStatus;
use App\Events\BookingActivity;


class BookingProcessController extends Controller
{
    use SchedulesTrait, BookingTrait, BookingProcessTrait;


    protected $client_subscription_service;

    protected $session_type_service;


    public function __construct(
        ClientSubscriptionService $client_subscription_service, 
        SessionTypeService $session_type_service
    )
    {
        $this->client_subscription_service = $client_subscription_service;
        $this->session_type_service = $session_type_service;
    }

    public function selectSessionType()
    {
        $session_types = SessionType::get(['id', 'name']);

        return view('pages.bookings.booking-process.select-session', compact('session_types'));
    }
    public function selectClientParticipants()
    {
        $clients = Client::whereHas('users', function($query){
            $query->where('is_active', true);
        })->with(['users'])->get();

        $session_types = SessionType::get(['id', 'name']);

        return view('pages.bookings.booking-process.select-client-participants', compact('clients', 'session_types'));
    }
    public function onboarding()
    {
        $user = auth()->user();

        if($user->hasRole('superadmin')){
            return redirect()->route('booking.select.client.participants');
        }

    	$categories = AssessmentCategory::has('questionnaires')->with('questionnaires')->get(['id', 'name']);
    	return view('pages.bookings.booking-process.onboarding', compact('categories'));
    }

    public function dateAndTime()
    {
        $has_assessment  = session()->has('assessment') ? 1 : 0;
        $is_firsttimer = $has_assessment ? (session('assessment.is_firsttimer') ? 1 : 0 ) : 0 ;
        $self_harm = $has_assessment ? (session('assessment.self_harm') ? 1 : 0) : 0;
        $harm_other_people = $has_assessment ? (session('assessment.harm_other_people') ? 1 : 0) : 0;
        $participants = session()->has('participants') ? ['participants' =>  session('participants') ] : ['participants' => collect([ auth()->user() ]) ];

    	return view('pages.bookings.booking-process.date-and-time', compact('has_assessment', 'is_firsttimer', 'self_harm', 'harm_other_people', 'participants'));
    }

    public function availableLinks()
    {
        return view('pages.bookings.booking-process.available-links');
    }

    public function reviewDetails()
    {
        return view('pages.bookings.booking-process.review');
    }

    public function successPage()
    {

        return view('pages.bookings.booking-process.success-page');

    }

    public function storeSessionType(Request $request)
    {
        dd($request->all());
        session(['session_type' => [
            'id' => $request->session_type_id,
            'name' => $request->session_name
        ] ]);

        dd(session('session_type'));
        
        return redirect()->route('booking.select.client.participants');
    }
    public function storeClientParticipants(Request $request){

        // store request to session
        $selected_session = SessionType::findOrFail($request->session_type);
        $selected_client = Client::findOrFail($request->client);
        $participants = User::whereIn('id', $request->participants)->get();
        
        session(['selected_session' => $selected_session ]);
        session(['selected_client' => $selected_client ]);
        session(['participants' => $participants]);
        
        return redirect()->route('booking.date.and.time');
    }

    /*  Post Methods */
    public function storeOnBoardingQuestions(Request $request)
    {
        $this->validate($request, [
            'self_harm' => ['required'],
            'harm_other_people' => ['required'],
            'onboarding_answers' => ['require_with_all']
        ]);

        session(['assessment' => [
            'is_firsttimer' => $request->is_firsttimer,
            'self_harm' => $request->self_harm,
            'harm_other_people' => $request->harm_other_people,
            'onboarding_answers' => $request->choice
        ]]);

        // dd(session('assessment.onboarding_answers'));

        return redirect()->route('booking.date.and.time')->with('success', 'Assessment has been submitted, please select date and time avialble');
    }

    public function storeDateTime(Request $request)
    {
        // store selected date to session, but must convert to full date first
        // $selected_date = date('l jS F Y', strtotime($request->selected_date));
        // $psych_schedule = PsychologistSchedule::findOrFail($request->schedule_id);
        // $timelist = TimeList::findOrFail($request->time);

        $schedule = PsychologistSchedule::withStart()
                        ->withTime()
                        ->where('psychologist', $request->psychologist)
                        ->with(["timeList", "psych"])
                        ->first();


        if(is_null($schedule)){

            return response()->json([
                'success' => false,
                'message' => 'Schedule Not Found'
            ], 404);
        }

        session(['booking_details' => [
            'schedule' => [
                'id' => $schedule->id
            ],
            'selected_date' => $schedule->start,
            'timelist' => [
                'id' => $schedule->timeList->id,
                'from' => $schedule->timeList->parseTimeFrom(),
                'to' => $schedule->timeList->parseTimeTo(),
            ],
            'psychologist' => [
                'id' => $schedule->psych->id,
                'name' => $schedule->psych->name,
                'avatar' => $schedule->psych->avatar
            ]
        ]]);

        return response()->json([
            'success' => true,
            'message' => 'Success please proceed to next step',
            'data' => session('booking_details')
        ], 200);
        
        // return redirect()->route('booking.review.details');
    }

    public function bookingConfirm(Request $request, BookingInterface $booking_interface)
    {
        $user = auth()->user();

        $minimum_time = now()->addHour(config('app.hour_before_booking'));

        $time = TimeList::findOrFail($request->time_id);

        $current_date = now()->toDateString();

        $has_selected_session = session()->has('selected_session');

        // if start date is equal to current date, then check the time if it is less than to minimum time
        if($request->selected_date == $current_date && $time->from < $minimum_time) return redirect()->back()->with('error', 'Selected time is beyond minimum hours!');

        // check if request scheduled date is less than current date
        if($request->selected_date < $current_date) return redirect()->back()->with('error', 'Cannot booked behind schedule!');

        $schedule = PsychologistSchedule::whereDate('start', $request->selected_date)
                        ->where('time_id', $request->time_id)
                        ->where('psychologist', $request->psychologist)
                        ->where('is_booked', false)
                        ->first();

        if(is_null($schedule)) return redirect()->back()->with('error', 'Schedule and time selected was not found');

        $status = BookingStatus::where('name', 'Pending')->first();

        if(is_null($status)) return redirect()->back()->with('error', 'Pending status not found!');

        // get client id
        $client_id = session()->has('selected_client') ? session('selected_client.id') : $user->client_id;

        // check client subscription package limit
        $individual_session = $this->session_type_service->getIndividualSession();

        if(!$has_selected_session && is_null($individual_session)) return redirect()->back()->with('error', 'Individual Session Not found!');

        $session_type_id = $has_selected_session ? session('selected_session.id') : $individual_session->id;

         // get client subscription;
        $client_subscription = $this->client_subscription_service->manageSubscriptionPackage($client_id, $session_type_id);

         // check client subscription existence
         if(is_null($client_subscription)) return redirect()->back()->with('error', 'No active subscription was found!');

        DB::beginTransaction();

        try {
                
            // means that the session is individual
            // if session is individual, the system must check first if the user is firstimer / repeater
            $is_firstimer = !$has_selected_session ? ($user->bookings->count() > 0 ? false : true) : false;

            $booking = Booking::create([

                'room_id' => uniqid(),
                'schedule' => $schedule->id,
                'time_id' => request('time_id'),
                'client_id' => session()->has('selected_client') ? session('selected_client.id') : $user->client_id,
                'client_subscription_id' => $client_subscription->id,
                'booked_by' => $user->id,
                'counselee' => $has_selected_session ? null : $user->id,
                'session_type_id' =>  $session_type_id,
                'self_harm' => $has_selected_session ? null : session('assessment.self_harm'),
                'harm_other_people' => $has_selected_session ? null : session('assessment.harm_other_people'),
                'is_firstimer' => $is_firstimer,
                'status' => $status->id,
                'link_to_session' => md5(uniqid(rand(), true)),
            ]);

            /**
             * Check if session has assessments,
             * it means that the session type is individual session and users answers
             * onboarding questions
             * */

            if(session()->has('assessment.onboarding_answers')) $this->submitAnswers($booking->id, session('assessment.onboarding_answers'));


            /**
             * check if session has participants
             * this means that the session is webinar or group
             * */

            $this->checkParticipants($request, $booking);

            /**
             * update schedule booked to true
             * */
            $schedule->update(['is_booked' => true]);

        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();

        // Send Email To psychologist / wellness coach
        event(new BookingActivity($booking));

        // flush the session
        $request->session()->forget(['assessment', 'participants']);
        
        return redirect()->route('session.view.calendar')->with('success', 'Successfully booked a session');
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $booking = Booking::where('id', $id)->update(['status' => $request->status ]);

        if($booking){

            return response()->json(['success' => true, 'message' => 'Successfully updated!', 'data' => [] ], 200);
        }

        return response()->json(['success' => false, 'message' => 'Internal Server Error', 'data' => [] ], 500);
    }
}
