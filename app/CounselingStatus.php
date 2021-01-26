<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CounselingStatus extends Model
{
    protected $fillable = [

    	'name', 'class'
    ];

    public $timestamps = false;

    public function schedules()
    {
    	return $this->hasMany(CounselingSchedule::class);
    }
}
