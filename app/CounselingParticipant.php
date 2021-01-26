<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CounselingParticipant extends Model
{
    protected $fillable = [

    	'user_id', 'schedule', 'time_in', 'time_out'
    ];

    public function users()
    {
    	return $this->hasMany('App\User', 'user_id');
    }

    public function schedule()
    {
    	return $this->belongsTo('App\CounselingSchedule', 'schedule');
    }
}
