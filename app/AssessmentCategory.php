<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentCategory extends Model
{
    protected $table = 'assessment_categories';
    protected $fillable = ['name'];
    public $timestamps = false;
}
