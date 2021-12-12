<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecifyOtherReason extends Model
{
    protected $table = 'specify_other_reasons';

    protected $fillable = ['rescheduled_booking_id', 'reason'];

    
}
