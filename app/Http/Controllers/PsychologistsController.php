<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Psychologist;
use App\Http\Traits\BookingTrait;
use App\Http\Traits\BookingSchedulesTrait;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Booking;
use App\Schedules\Schedule;

class PsychologistsController extends Controller
{
    use BookingTrait, BookingSchedulesTrait, RegistersUsers;

    public function home()
    {
        $plucked_schedules = auth()->user()->schedules()->whereDate('start', '>=', now()->toDateString())->pluck('id');

        $upcoming_sessions = $this->bookingsQuery();

        $completed_sessions = $this->countByStatus(2);

        $cancelled_bookings = $this->countByStatus(4);

        $no_show = $this->countByStatus(3);

        $rescheduled = $this->countByStatus(5);
        
        $unclosed_bookings = $this->psychSessions(1)
                                ->whereIn('schedule', $this->pluckPastdueSchedules())
                                ->whereNotNull('counselee')
                                ->latest()
                                ->paginate(10);

        return view('pages.psychologists.main', compact(
            'unclosed_bookings', 
            'upcoming_sessions', 
            'completed_sessions', 
            'cancelled_bookings',
            'no_show',
            'rescheduled'
        ));
    }
    public function bookings()
    {
        $bookings = $this->bookingsQuery();
        $upcoming = $this->findUpcomingSession();
        return view('pages.psychologists.bookings', compact('bookings', 'upcoming'));
    }

    public function schedules(Schedule $schedule)
    {
        $user = auth()->user();
        $schedules = $schedule->query($user)->get();
        $psychologists = User::withRole('psychologist')->get(['id', 'name']);

        return view('pages.psychologists.schedule', compact('schedules', 'psychologists'));
    }

    protected function psychSessions($status){

        return Booking::where('status', $status)
            ->where(function($query){
            if(auth()->user()->hasRole('psychologist')){
                $query->whereIn('schedule', auth()->user()->schedules->pluck('id'));
            }
        });
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $psychologists = User::withRole('psychologist')->orderBy('created_at', 'desc')->paginate(10);

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
        $this->validateUser($request->all())->validate();

        $user = $this->createUser($request->all());

        // add psychologist role to user
        $user->roles()->attach(2);

        return redirect()->route('psychologists.index')->with('success', 'Successfully created!');
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
        $user = User::findOrFail($id);

        if($request->has('status')){

            $user->update(['is_active' => !$user->is_active]);
        }

        return redirect()->route('psychologists.index')->with('success', 'Status Updated!');
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
