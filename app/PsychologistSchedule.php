<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsychologistSchedule extends Model
{
    protected $fillable = [

    	'psychologist', 'start', 'end', 'time', 'status', 'book_with'
    ];

    public $timestamps = false;

    public function psych()
    {
    	return	$this->belongsTo(User::class, 'psychologist');
    }

    public function book_with()
    {
        return $this->belongsTo(User::class, 'book_with');
    }

    public function status()
    {
    	return $this->belongsTo(PsychoSchedStatus::class, 'status');
    }

    public function time()
    {
        return $this->belongsTo(TimeList::class, 'time');
    }
    public function bookWith()
    {
        return $this->belongsTo(User::class, 'book_with');
    }
}
