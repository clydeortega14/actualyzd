<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Psychologist;
use App\Http\Traits\BookingTrait;
use App\Http\Traits\BookingSchedulesTrait;

class PsychologistsController extends Controller
{
    use BookingTrait, BookingSchedulesTrait;

    public function home()
    {
        $plucked_schedules = auth()->user()->schedules()->whereDate('start', '>=', now()->toDateString())->pluck('id');

        $upcoming_sessions = $this->bookingsQuery();
        
        $unclosed_bookings = $this->unClosedBookings()
                                ->whereIn('schedule', $this->pluckPastdueSchedules())
                                ->where(function($query){
                                    if(auth()->user()->hasRole('psychologist')){
                                        $query->whereIn('schedule', auth()->user()->schedules->pluck('id'));
                                    }
                                })->whereNotNull('counselee')
                                ->get();

        return view('pages.psychologists.main', compact('unclosed_bookings', 'upcoming_sessions'));
    }
    public function bookings()
    {
        $bookings = $this->bookingsQuery();
        $upcoming = $this->findUpcomingSession();
        return view('pages.psychologists.bookings', compact('bookings', 'upcoming'));
    }

    public function schedules()
    {
        return view('pages.psychologists.schedule');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $psychologists = Psychologist::with('user')->get();

        return view('pages.superadmin.psychologists.index', compact('psychologists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
