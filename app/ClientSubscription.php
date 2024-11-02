<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientSubscription extends Model
{
    protected $table = 'client_subscriptions';

    protected $fillable = ['client_id', 'package_id', 'reference_no', 'completion_date', 'subscription_status_id'];


    public function client()
    {
    	return $this->belongsTo(Client::class, 'client_id');
    }

    public function package()
    {
    	return $this->belongsTo(Package::class, 'package_id');
    }

    public function status()
    {
    	return $this->belongsTo(SubscriptionStatus::class, 'subscription_status_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function wholeDate()
    {
        return date('F j, Y', strtotime($this->completion_date));
    }

    public function histories()
    {
        return $this->hasMany(ClientSubscriptionHistory::class);
    }

    public function scopeWithAlmostExpired($query)
    {
        return $query->where('completion_date', '>', now()->toDateString())
                ->orderBy('completion_date', 'asc');
    }

    
}
