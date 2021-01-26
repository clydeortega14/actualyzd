<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CounselingType extends Model
{
    protected $fillable = [

    	'name', 'description', 'is_active', 'public'

    ];

    public $timestamps = false;

    public function schedules()
    {
    	return $this->hasMany(CounselingSchedule::class);
    }
}
