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

class BookingProcessController extends Controller
{
    use SchedulesTrait, BookingTrait;
    
    public function onboarding()
    {
    	$categories = AssessmentCategory::has('questionnaires')->with('questionnaires')->get(['id', 'name']);

    	return view('pages.bookings.booking-process.onboarding', compact('categories'));
    }

    public function dateAndTime()
    {
    	return view('pages.bookings.booking-process.date-and-time');
    }

    public function reviewDetails()
    {
        return view('pages.bookings.booking-process.review');
    }

    public function successPage()
    {

        return view('pages.bookings.booking-process.success-page');

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
        
        return redirect()->route('booking.review.details');
    }
    public function bookingConfirm(Request $request)
    {
        DB::beginTransaction();

        try {

            $booking = Booking::create([

                'schedule' => session('booking_details.schedule.id'),
                'time_id' => session('booking_details.timelist.id'),
                'client_id' => auth()->user()->client_id,
                'booked_by' => auth()->user()->id,
                'counselee' => auth()->user()->id,
                'session_type_id' => 1,
                'self_harm' => session('assessment.self_harm'),
                'is_firstimer' => session('assessment.is_firsttimer'),
                'status' => 1
            ]);

            if($request->session()->has('assessment.onboarding_answers')){

                $this->submitAnswers($booking->id, session('assessment.onboarding_answers'));
            }
            
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('booking.success.page')->with('success', 'Successfully booked a session');
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $booking = Booking::where('id', $id)->update(['status' => $request->status]);
        return $booking;
        return response()->json(['success' => true, 'message' => 'Successfully updated', 'data' => [] ], 200);
    }
}
