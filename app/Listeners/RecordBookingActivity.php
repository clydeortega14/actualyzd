<?php

namespace App\Listeners;

use App\Events\BookingActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\ActivityLog;
use App\ActivityType;
use Illuminate\Support\Facades\Log;
use App\Mail\SessionBooked;
use Illuminate\Support\Facades\Mail;

class RecordBookingActivity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookingActivity  $event
     * @return void
     */
    public function handle(BookingActivity $event)
    {
        // check if booking booked by is null
        if(is_null($event->booking->booked_by)) Log::error('ERROR: booked_by is null');
        
        // find specific activity type
        $activity_type = ActivityType::where('description', 'Booked a session')->first();

        // check activity type
        if(is_null($activity_type)) Log::error('ERROR: Booked a session ActivityType was not found!');

        // email sending
        $psychologist = $event->booking->toSchedule->psych;
        Mail::to($psychologist)->send(new SessionBooked);

        $activity_log = ActivityLog::create([
            'user_id' => $event->booking->booked_by,
            'type_id' => $activity_type->id,
        ]);
        
        Log::info('New booking has been created!');
    }
}
