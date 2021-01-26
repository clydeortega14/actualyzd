<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [

    	'psychologist', 'statement', 'rate', 'evaluator'

    ];


    public function psychologist()
    {
    	return $this->belongsTo(Psychologist::class, 'psychologist');
    }

    public function statement()
    {
    	return $this->belongsTo(FeedBack::class, 'statement');
    }

    public function rate()
    {
    	return $this->belongsTo(RateList::class, 'rate');
    }

    public function evaluator()
    {
    	return $this->belongsTo(User::class, 'evaluator');
    }
}
