<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'type_id'
    ];

    public function type()
    {
        return $this->hasOne(ActivityType::class, 'id', 'type_id');
    }
}
