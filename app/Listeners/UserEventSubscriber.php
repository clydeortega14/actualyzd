<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use App\ActivityLog;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserRegister($event) {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'type_id' => 1, // 1 = 'Registered'
        ]);
    }

    /**
     * Handle user login events.
     */
    public function handleUserLogin($event) {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'type_id' => 2, // 2 = 'Logged in'
        ]);
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event) {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'type_id' => 3, // 3 = 'Logged out'
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen('Illuminate\Auth\Events\Registered', 'App\Listeners\UserEventSubscriber@handleUserRegister');
        $events->listen('Illuminate\Auth\Events\Login', 'App\Listeners\UserEventSubscriber@handleUserLogin');
        $events->listen('Illuminate\Auth\Events\Logout', 'App\Listeners\UserEventSubscriber@handleUserLogout');
    }
}

