<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentCategory extends Model
{
    protected $table = 'assessment_categories';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function questionnaires()
    {
    	return $this->hasMany('App\AssessmentQuestionnaire', 'category');
    }
    public function bookings()
    {
    	return $this->hasMany(Booking::class, 'main_concern');
    }
}
