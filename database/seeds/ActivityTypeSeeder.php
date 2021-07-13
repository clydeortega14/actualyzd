<?php

use Illuminate\Database\Seeder;
use App\ActivityType;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivityType::create(['description' => 'Registered']); // id = 1
        ActivityType::create(['description' => 'Logged in']); // id = 2
        ActivityType::create(['description' => 'Logged out']); // id = 3
        ActivityType::create(['description' => 'Booked a session']); // id = 4
    }
}
