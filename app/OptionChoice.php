<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionChoice extends Model
{
    protected $table = 'option_choices';
    protected $fillable = ['option', 'value', 'display_name'];
    public $timestamps = false;

    public function option()
    {
    	return $this->belongsTo('App\AssessmentOption', 'option');
    }
}
