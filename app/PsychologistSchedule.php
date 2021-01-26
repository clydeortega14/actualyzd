<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsychologistSchedule extends Model
{
    protected $fillable = [

    	'psycho_id', 'schedule', 'is_active', 'status'
    ];


    public $timestamps = false;

    public function psychologist()
    {
    	return	$this->belongsTo(Psychologist::class, 'psycho_id');
    }

    public function status()
    {
    	return $this->belongsTo(PsychoSchedStatus::class, 'status');
    }
}
