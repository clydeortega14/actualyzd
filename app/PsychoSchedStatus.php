<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsychoSchedStatus extends Model
{
    protected $fillable = [

    	'status', 'class'

    ];


    public $timestamps = false;
}
