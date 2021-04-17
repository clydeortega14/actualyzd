<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSchedule extends Model
{
    protected $table = 'time_schedules';
    protected $fillable = ['schedule', 'time', 'is_booked'];

    public function toSchedule()
    {
    	return $this->belongsTo('App\PsychologistSchedule', 'schedule');
    }
    public function toTime()
    {
    	return $this->belongsTo('App\TimeList', 'time');
    }
}
