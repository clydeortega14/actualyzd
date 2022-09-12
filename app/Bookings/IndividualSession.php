<?php

namespace App\Bookings;

use App\Bookings\AbstractBooking;
use App\Booking;
use App\Bookings\BookingInterface;
use App\Http\Traits\BookingTrait;
use App\Bookings\Traits\EncryptLink;
use App\PsychologistSchedule;

class IndividualSession extends AbstractBooking implements BookingInterface {

	use BookingTrait, EncryptLink;

	public function create()
	{

        $schedule = PsychologistSchedule::whereDate('start', request('selected_date'))
            ->where('time_id', request('time'))
            ->where('psychologist', request('psychologist'))
            ->where('is_booked', false)
            ->first();

        if(is_null($schedule)){

            return redirect()->back()->with('error', 'Sorry!, the schedule you have selected was unavailable' );
        }


		 $booking = Booking::create([

            'room_id' => uniqid(),
            'schedule' => $schedule->id,
            'time_id' => request('time'),
            'client_id' => auth()->user()->client_id,
            'booked_by' => auth()->user()->id,
            'counselee' => auth()->user()->id,
            'session_type_id' => 1,
            'self_harm' => session('assessment.self_harm'),
            'harm_other_people' => session('assessment.harm_other_people'),
            'is_firstimer' => session('assessment.is_firsttimer'),
            'status' => 1,
            'link_to_session' => $this->encLinkToSession(),
        ]);

        if(session()->has('assessment.onboarding_answers')){
        	$this->submitAnswers($booking->id, session('assessment.onboarding_answers'));
        }
	}
}