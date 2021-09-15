<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Http\Traits\BookingTrait;

class MemberController extends Controller
{
    use BookingTrait;

    public function home()
    {

        if(request()->session()->exists('assessment') || request()->session()->exists('booking_details')){
            request()->session()->forget(['assessment', 'booking_details']);
        }

        $bookings =  $this->bookingsQuery();
        $upcoming = $this->findUpcomingSession();
        $total_bookings = $this->totalBookings();
        $booking_by_statuses = $this->bookingByStatus();
    	
    	return view('pages.members.index', compact('bookings', 'total_bookings', 'booking_by_statuses', 'upcoming'));
    }
}
