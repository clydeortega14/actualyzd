<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReasonOption extends Model
{
    protected $table = 'reason_options';

    protected $fillable = ['option_name'];

    public $timestamps = false;
}
