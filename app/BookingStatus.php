<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingStatus extends Model
{
    protected $table = 'booking_statuses';
    protected $fillable = ['name', 'class', 'border_color', 'background_color', 'text_color'];
    public $timestamps = false;

    public function bookings()
    {
    	return $this->hasMany(Booking::class, 'status');
    }
}
