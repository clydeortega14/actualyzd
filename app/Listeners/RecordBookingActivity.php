<?php

namespace App\Listeners;

use App\Events\BookingActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\ActivityLog;
use Illuminate\Support\Facades\Log;

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
        // email sending
        
        $activity_log = ActivityLog::create([
            'user_id' => $event->booking->counselee,
            'type_id' => 4, // 4 = 'Booked a session'
        ]);

        Log::info('Logging...', ['activity_log' => $activity_log, 'event' => $event->booking]);
    }
}
