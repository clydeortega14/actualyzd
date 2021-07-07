<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssessmentCategory;
use App\Http\Traits\SchedulesTrait;

class BookingProcessController extends Controller
{
    use SchedulesTrait;
    
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


        // store firsttimer / repeater to session
        session(['is_firsttimer' => $request->is_firsttimer]);

        // store intent to self harm to session
        session(['self_harm' => $request->self_harm]);

        // store onboarding answers to session
        session(['onboarding_answers' => $request->choice ]);

        return redirect()->route('booking.date.and.time')->with('success', 'Assessment has been submitted, please select date and time avialble');
    }
}
