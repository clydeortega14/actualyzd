<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionStatus extends Model
{
    protected $table = 'subscription_statuses';

    protected $fillable = ['name', 'class'];

    public $timestamps = false;


    public function scopeWithStatus($query, $status)
    {
        return $query->where('name', $status);
    }
}
