<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    protected $fillable = [

    	'statement'
    ];

    public $timestamps = false;

    protected function evaluations()
    {
    	return $this->hasMany(Evaluation::class);
    }
}
