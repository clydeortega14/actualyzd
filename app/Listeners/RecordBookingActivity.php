<?php

namespace App\Listeners;

use App\Events\BookingActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\ActivityLog;

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
        ActivityLog::create([
            'user_id' => Auth::id(),
            'type_id' => 4, // 4 = 'Booked a session'
        ]);
    }
}
