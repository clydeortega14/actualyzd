<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
	  * The attributes that is mass assignable
	  *
	  * @var array
    */

    protected $fillable = [

    	'name', 'description', 'is_active'
    ];

    public $timestamps = false;

    public function schedules()
    {
    	return $this->hasMany('App\CounselingSchedule');
    }
}
