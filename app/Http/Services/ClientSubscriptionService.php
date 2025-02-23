<?php

namespace App\Http\Services;

use App\ClientSubscription;
use App\Http\Services\SubscriptionStatusService;
use App\Booking;

class ClientSubscriptionService {

    protected $subscription_status_service;

    public function __construct(SubscriptionStatusService $subscription_status_service)
    {
        $this->subscription_status_service = $subscription_status_service;
    }

    public function getActiveSubscriptions($client_id)
    {
        return ClientSubscription::where('client_id', $client_id)
                                    ->withAlmostExpired()
                                    ->whereIn('subscription_status_id', $this->subscription_status_service->getActiveSubscriptionById())
                                    ->get();
    }

    public function manageSubscriptionPackage($client_id, $session_type_id)
    {
        $active_subscriptions = $this->getActiveSubscriptions($client_id);

        

        if(count($active_subscriptions) > 0){
            foreach($active_subscriptions as $active_subscription){

                // get active subscription package.
                $package = $active_subscription->package;
    
                // package services
                $package_service = $package->services()->where('session_type_id', $session_type_id)->first();
    
                if(is_null($package_service)){
                    return [
                        'error' => true,
                        'message' => 'Package service type was not found',
                        'code' => 404
                    ];
                }
    
                // count booking subscription with session
                $count_bookings = Booking::where('client_subscription_id', $active_subscription->id)
                                    ->where('session_type_id', $session_type_id)
                                    ->count();
    
                // check if active subscription package has already reached its limit
                
                if($package_service->limit > $count_bookings)
                {
                    return [
                        'error' => false,
                        'message' => 'Subscription found.',
                        'code' => 200,
                        'subscription' => $active_subscription
                    ];
                }
    
                if($package_service->limit <= $count_bookings)
                {
                    return [
                        'error' => true,
                        'message' => 'Subscription has already reached its limited usage do you wish to continue?',
                        'code' => 422
                    ];
                }
                
            }
        }else{
            return [
                'error' => true,
                'message' => 'No active subscription was found!',
                'code' => 404
            ];
        }
    }
}