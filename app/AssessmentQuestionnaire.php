<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentQuestionnaire extends Model
{
    protected $table = 'assessment_questionnaires';
    protected $fillable = ['category', 'question', 'option'];

    public function category()
    {
    	return $this->belongsTo('App\AssessmentCategory');
    }

    public function option()
    {
    	return $this->belongsTo('App\AssessmentOption')
    }
}
