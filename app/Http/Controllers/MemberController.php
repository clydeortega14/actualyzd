<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Http\Traits\BookingTrait;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Client;

class MemberController extends Controller
{
    use BookingTrait, RegistersUsers;

    public function index(){

        $clients = Client::where('is_active', true)->get(['id', 'name']);
        $members = User::where(function($query){

            if(auth()->user()->hasRole('admin')){

                $query->where('client_id', auth()->user()->client_id);
            }

        })->withRole('member')->latest()->paginate(10);

        return view('pages.superadmin.members.index', compact('members', 'clients'));
    }

    public function home()
    {
        if(request()->session()->has('assessment') || request()->session()->has('booking_details') || request()->session()->has('booking')){
            request()->session()->forget(['assessment', 'booking_details', 'booking']);
        }

        $bookings =  $this->bookingsQuery();
        $upcoming = $this->findUpcomingSession();
        $total_bookings = $this->totalBookings();
        $booking_by_statuses = $this->bookingByStatus();
    	
    	return view('pages.members.index', compact('bookings', 'total_bookings', 'booking_by_statuses', 'upcoming'));
    }

    public function store(Request $request)
    {
        $this->validateUser($request->all())->validate();

        $user = $this->createUser($request->all());

        if($request->has('client')){

            $user->client_id = $request->client;
            $user->save();
        }

        $user->roles()->attach(4);

        return redirect()->back()->with('success', 'Successfully Created!');
    }

    public function update(User $user, Request $request)
    {
        if($request->has('status')){
            $user->update(['is_active' => !$user->is_active]);
        }

        return redirect()->back()->with('success', 'Status updated!');
    }
}
