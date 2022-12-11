<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = 
        [
            'room_id',
            'schedule', 
            'time_id',
            'client_id',
            'counselee',
            'booked_by', 
            'session_type_id',
            'is_firstimer',
            'self_harm',
            'harm_other_people',
            'status',
            'link_to_session',
            'main_concern'
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

    public function cancelled(){
        return $this->hasOne(CancelledBooking::class);
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
    public function mainConcern()
    {
        return $this->belongsTo(AssessmentCategory::class, 'main_concern');
    }
    public function chats()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function getWholeDateAttribute()
    {
        return date('m/d/Y', strtotime($this->created_at));
    }

    public function scopeWithClient($query)
    {
        $user = auth()->user();

        // if authenticated user and auth user has role admin
        if($user->hasRole('admin'))
        {
            // query where user client id
            $query->where('client_id', $user->client_id);
        }

        // if $user and $user has role of superadmin
        if($user->hasRole('superadmin') && request()->has('client')){

            // query where client is request request client 
            $query->where('client_id', request('client'));
        }
    }
    public function scopeWithStatus($query, $status)
    {
        $query->where('status', $status);
    }

    public function scopeWithUser($query, $user)
    {
        $query->where('counselee', $user);
    }
}
