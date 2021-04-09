<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Http\Traits\BookingTrait;

class MemberController extends Controller
{
    use BookingTrait;

    public function __construct()
    {
    	//
    }

    public function home()
    {
        $bookings = $this->bookingsQuery();

        $total_bookings = $this->totalBookings();
        $booking_by_statuses = $this->bookingByStatus();
    	
    	return view('pages.members.index', compact('bookings', 'total_bookings', 'booking_by_statuses'));
    }
}
