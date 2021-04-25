<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowupSession extends Model
{
   	protected $table = 'followup_sessions';

   	protected $fillable = ['name'];

   	public $timestamps = false;
}
