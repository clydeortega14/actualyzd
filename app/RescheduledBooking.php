<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RescheduledBooking extends Model
{
    protected $table = 'rescheduled_bookings';

    protected $fillable = ['booking_id', 'updated_by', 'reason'];

    public function booking()
    {
    	return $this->belongsTo(Booking::class);
    }

    public function updatedBy()
    {
    	return $this->belongsTo(User::class);
    }
}
