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

    public function wholeDate()
    {
        return date('F j, Y', strtotime($this->completion_date));
    }

    public function histories()
    {
        return $this->hasMany(ClientSubscriptionHistory::class);
    }
}
