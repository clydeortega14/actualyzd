<?php

use Illuminate\Database\Seeder;
use App\SubscriptionStatus;

class SubscriptionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubscriptionStatus::create(['name' => 'subscribed']);
        SubscriptionStatus::create(['name' => 'renewed']);
        SubscriptionStatus::create(['name' => 'cancelled']);
        SubscriptionStatus::create(['name' => 'expired']);
        SubscriptionStatus::create(['name' => 'pastdue']);
    }
}
