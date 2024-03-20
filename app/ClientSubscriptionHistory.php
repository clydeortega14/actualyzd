<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientSubscriptionHistory extends Model
{
    protected $table = 'client_subscription_histories';

    protected $fillable = ['client_subscription_id', 'reference_no', 'amount', 'paid', 'subscription_status_id'];


    public function clientSubscription()
    {
        return $this->belongsTo(ClientSubscription::class);
    }

    public function status()
    {
        return $this->belongsTo(SubscriptionStatus::class);
    }
}
