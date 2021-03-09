<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionChoice extends Model
{
    protected $table = 'option_choices';
    protected $fillable = ['option', 'value', 'display_name'];
    public $timestamps = false;
}
