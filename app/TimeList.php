<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeList extends Model
{
    protected $fillable = ['from', 'to'];

    public $timestamps = false;

    public function schedules(){

        return $this->hasMany(PsychologistSchedule::class, 'time');
    }
    public function parseTimeFrom()
    {
    	return date("g:i a", strtotime($this->from));
    }

    public function parseTimeTo()
    {
    	return date("g:i a", strtotime($this->to));
    }

    public function parseTime($date)
    {
        return date("g:i a", strtotime($date));
    }
    public function getTimeAccessAttribute($date){

        return \Carbon\Carbon::parse($date);
    }
}
