<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = 
        [
            'schedule', 
            'time_id',
            'client_id',
            'counselee',
            'booked_by', 
            'session_type_id', 
            'status'
        ];

    public function toSchedule()
    {
        return $this->belongsTo(PsychologistSchedule::class, 'schedule');
    }

    public function toClient()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function time()
    {
        return $this->belongsTo('App\TimeList', 'time_id');
    }

    public function toCounselee()
    {
        return $this->belongsTo(User::class, 'counselee');
    }

    public function bookedBy()
    {
    	return $this->belongsTo('App\User', 'booked_by');
    }

    public function sessionType()
    {
        return $this->belongsTo('App\SessionType', 'session_type_id');
    }

    public function toStatus()
    {
    	return $this->belongsTo('App\BookingStatus', 'status');
    }

    public function toCategory()
    {
        return $this->belongsTo('App\AssessmentCategory', 'category_id');
    }
    public function assessmentAnswers()
    {
        return $this->hasMany(AssessmentAnswer::class);
    }
    public function reschedule()
    {
        return $this->hasOne(RescheduledBooking::class);
    }
    public function progressReport()
    {
        return $this->hasOne(ProgressReport::class);
    }
    public function participants()
    {
        return $this->belongsToMany(User::class, 'session_participants', 'booking_id', 'participant');
    }

    public function scopeWithClient($query)
    {
        if(request()->has('client')){
            $query->where('client_id', request('client'));
        }
    }
}
