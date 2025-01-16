<?php

namespace App\Http\Services;

use App\SubscriptionStatus;

class SubscriptionStatusService {

    public function getActiveStatuses()
    {
        return SubscriptionStatus::whereIn('name', ['subscribed', 'renewed']);
    }

    public function getActiveSubscriptionById()
    {
        return $this->getActiveStatuses()->pluck('id')->toArray();
    }
}