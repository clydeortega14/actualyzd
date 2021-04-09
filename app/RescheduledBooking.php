<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RescheduledBooking extends Model
{
    protected $table = 'rescheduled_bookings';

    protected $fillable = ['booking_id', 'reason'];

    public function booking()
    {
    	return $this->belongsTo(Booking::class);
    }
}
