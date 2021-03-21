<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentAnswer extends Model
{
    protected $table = 'assessment_answers';
    protected $fillable = ['booking_id', 'category_id', 'questionnaire_id', 'answer'];

    public function booking()
    {
    	return $this->belongsTo('App\Booking', 'booking_id');
    }

    public function questionnaire()
    {
    	return $this->belongsTo('App\AssessmentQuestionnaire', 'questionnaire_id');
    }
}
