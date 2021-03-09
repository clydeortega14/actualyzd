<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentOption extends Model
{
    protected $table = 'assessment_options';
    protected $fillable = ['name'];
    public $timestamps = false;
}
