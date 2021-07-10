<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    public function type()
    {
        return $this->hasOne(ActivityType::class, 'type_id');
    }
}
