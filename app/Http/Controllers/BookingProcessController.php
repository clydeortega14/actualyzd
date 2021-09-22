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
use App\SessionType;
use App\Client;
use App\User;
use App\Bookings\BookingInterface;
use App\TimeSchedule;


class BookingProcessController extends Controller
{
    use SchedulesTrait, BookingTrait;

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
    	return view('pages.bookings.booking-process.date-and-time');
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

            'is_firsttimer' => ['required'],
            'self_harm' => ['required'],
            'onboarding_answers' => ['require_with_all']
        ]);

        session(['assessment' => [
            'is_firsttimer' => $request->is_firsttimer == "1" ? true : false,
            'self_harm' => $request->self_harm == "1" ? true : false,
            'onboarding_answers' => $request->choice
        ]]);

        return redirect()->route('booking.date.and.time')->with('success', 'Assessment has been submitted, please select date and time avialble');
    }

    public function storeDateTime(Request $request)
    {
        // store selected date to session, but must convert to full date first
        $selected_date = date('l jS F Y', strtotime($request->selected_date));
        $psych_schedule = PsychologistSchedule::findOrFail($request->schedule_id);
        $timelist = TimeList::findOrFail($request->time);

        session(['booking_details' => [
            'selected_date' => $selected_date,
            'timelist' => [
                'id' => $timelist->id,
                'from' => $timelist->parseTimeFrom(),
                'to' => $timelist->parseTimeTo(),
            ],
            'schedule' => [
                'id' => $psych_schedule->id,
                'psychologist' => $psych_schedule->psych->name
            ]
        ]]);
        
        return redirect()->route('booking.available.links');
    }
    public function bookingConfirm(Request $request, BookingInterface $booking_interface)
    {
        // find schedule by schedule_id
        $schedule = PsychologistSchedule::findOrFail(session('booking_details.schedule.id'));

        // find time schedules by request schedule and time_id
        $time_schedule = TimeSchedule::where('schedule', session('booking_details.schedule.id'))
            ->where('time', session('booking_details.timelist.id'))->first();


        DB::beginTransaction();
        try {
            if(!is_null($schedule) && !is_null($time_schedule)){
                $booking_interface->create();

                DB::commit();

                $time_schedule->update(['is_booked' => true]);
            }else{

                return redirect()->back()->with('error', 'Schedule and time selected was not found');
            }
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }
        
        return redirect()->route('booking.success.page')->with('success', 'Successfully booked a session');
    }

    public function updateBookingStatus(Request $request, $id)
    {

        $booking = Booking::where('id', $id)->update(['status' => $request->status ]);

        if($booking){

            return response()->json(['success' => true, 'message' => 'Successfully updated!', 'data' => [] ], 200);
        }

        // $booking = Booking::findOrFail($id);

        // if($request->status == 2){

        //     // redirect to progress reports
        //     return redirect()->route('progress.report.create-for-booking', $id);
        // }

        // if($request->status == 4){
        //     // redirect to reason for canceling
        //     return redirect()->route('bookings.cancel', $booking->id);
        // }

        // if($request->status == 5){

        //     return redirect()->route('booking.reschedule', $booking->id);
        // }

        // if($request->status == 3){
        //      $booking->update(['status' => 3]); 
        //      return redirect()->route('home');
        // }
    }
}
