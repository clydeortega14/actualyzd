<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CounselingSchedule extends Model
{
    protected $fillable = [

    	'psycho_sched_id', 'user_id', 'counseling_type_id', 'channel', 'status'

    ];


    public function psychoSched()
    {
    	return $this->belongsTo('App\PsychologistSchedule', 'psycho_sched_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function type()
    {
    	return $this->belongsTo(CounselingType::class, 'counseling_type_id');
    }

    public function channel()
    {
    	return $this->belongsTo(Channel::class, 'channel');
    }

    public function status()
    {
    	return $this->belongsTo(CounselingStatus::class, 'status');
    }

    public function participants()
    {
    	return $this->hasMany(CounselingParticipant::class);
    }
}
