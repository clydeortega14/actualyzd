<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssessmentCategory;

class BookingProcessController extends Controller
{
    public function onboarding()
    {
    	$categories = AssessmentCategory::has('questionnaires')->with('questionnaires')->get(['id', 'name']);

    	return view('pages.bookings.booking-process.onboarding', compact('categories'));
    }

    public function dateAndTime()
    {
    	return view('pages.bookings.booking-process.date-and-time');
    }
}
