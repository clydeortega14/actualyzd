<?php

namespace App\Http\Traits;
use App\Booking;
use DB;

trait BookingTrait {


	public function bookingsQuery()
	{
		return Booking::where(function($query){

            $user = auth()->user();

            $this->bookingsFoMember($user, $query);

            $this->bookingsForPsychologist($user, $query);

        })->get();
	}

    public function totalBookings()
    {
        return $this->bookingsQuery()->count();
    }
    public function bookingByStatus()
    {
        return Booking::select(DB::raw('count(*) as booking_count, status', 'schedule', 'booked_by'))
            ->groupBy('status')
            ->with(['toStatus'])
            ->get();
    }

    public function bookingsFoMember($user, $query)
    {
        if($user->hasRole('member')){

            $query->where('booked_by', $user->id);
        }
    }
    public function bookingsForPsychologist($user, $query)
    {
        // when user is a psychologist
        if($user->hasRole('psychologist')){

            $sched_id = $user->schedules->pluck('id');

            $query->whereIn('schedule', $sched_id);
        }
    }
}