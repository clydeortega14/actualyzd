<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RescheduledBooking extends Model
{
    protected $table = 'rescheduled_bookings';

    protected $fillable = ['booking_id', 'updated_by', 'reason_option_id', 'reason'];

    public function booking()
    {
    	return $this->belongsTo(Booking::class);
    }

    public function updatedBy()
    {
    	return $this->belongsTo(User::class);
    }

    public function reasonOption(){

        return $this->belongsTo(ReasonOption::class, 'reason_option_id');
    }

    public function othersSpecify(){

        return $this->hasOne(SpecifyOtherReason::class);
    }
}
