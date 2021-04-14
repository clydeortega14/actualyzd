<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    protected $table = 'session_types';

    protected $fillable = ['name'];

    public $timestamps = false;
}
