<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;

class MemberController extends Controller
{
    public function home()
    {
    	$bookings = Booking::where(function($query){

    		$user = auth()->user();

    		if($user->hasRole('member')){
    			$query->where('booked_by', $user->id);
    		}

    	})->get();

    	
    	return view('pages.members.index', compact('bookings'));
    }
}
