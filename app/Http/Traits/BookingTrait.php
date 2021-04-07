<?php

namespace App\Http\Traits;
use App\Booking;

trait BookingTrait {

	public function bookingsQuery()
	{
		return Booking::where(function($query){

            $user = auth()->user();

            if($user->hasRole('member')){

                $query->where('booked_by', $user->id);
            }

            // when user is a psychologist
            if($user->hasRole('psychologist')){

            	$sched_id = $user->schedules->pluck('id');

            	$query->whereIn('schedule', $sched_id);
            }

        })->get();
	}
}