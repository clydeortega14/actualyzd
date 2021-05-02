<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionParticipant extends Model
{
    protected $table = 'session_participants';

    protected $fillable = ['booking_id', 'participant'];

    public function booking()
    {
    	return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function participants()
    {
    	return $this->hasMany(User::class, 'participant');
    }
}
