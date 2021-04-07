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
        $bookings = $this->bookingsQuery();
    	
    	return view('pages.members.index', compact('bookings'));
    }
}
