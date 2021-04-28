<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsychologistSchedule extends Model
{
    protected $fillable = [
    	'psychologist', 'start', 'end'
    ];

    public $timestamps = false;

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
}
