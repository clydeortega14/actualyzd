<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = ['schedule', 'booked_by', 'actioned_by', 'status', 'category_id'];

    public function toSchedule()
    {
    	return $this->belongsTo('App\PsychologistSchedule', 'schedule');
    }

    public function bookedBy()
    {
    	return $this->belongsTo('App\User', 'booked_by');
    }

    public function actionedBy()
    {
    	return $this->belongsTo('App\User', 'actioned_by');
    }
    public function toStatus()
    {
    	return $this->belongsTo('App\BookingStatus', 'status');
    }

    public function toCategory()
    {
        return $this->belongsTo('App\AssessmentCategory', 'category_id');
    }
}
