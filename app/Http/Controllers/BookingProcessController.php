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
}
