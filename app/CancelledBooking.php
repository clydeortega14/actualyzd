<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelledBooking extends Model
{
    protected $table = 'cancelled_bookings';

    protected $fillable = ['booking_id', 'cancelled_by', 'reason_option_id', 'others_specify'];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    public function reasonOption()
    {
        return $this->belongsTo(ReasonOption::class, 'reason_option_id');
    }
}
