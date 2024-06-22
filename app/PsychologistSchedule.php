<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsychologistSchedule extends Model
{
    protected $fillable = [
    	'psychologist', 'start', 'end', 'time_id', 'is_booked'
    ];

    public $timestamps = false;

    public function booking()
    {
        return $this->hasOne(Booking::class, 'schedule');
    }

    public function timeList(){

        return $this->belongsTo(TimeList::class, 'time_id');
    }

    public function getFormatStartAttribute()
    {
        return date('F j, Y', strtotime($this->start));
    }

    public function psych()
    {
    	return	$this->belongsTo(User::class, 'psychologist');
    }
    public function timeSchedules(){
    	return $this->hasMany(TimeSchedule::class, 'schedule');
    }

    public function formattedStart()
    {
        return date('m/d/Y', strtotime($this->start));
    }
    public function fullStartDate()
    {
        return date('l, jS F Y', strtotime($this->start));
    }

    public function scopeWithStart($query){

        $query->whereDate('start', request()->date);
    }

    public function scopeWithTime($query){
        $query->where('time_id', request()->time_id);
    }
    public function scopeWithNotBooked($query){
        $query->where('is_booked', false);
    }
}
