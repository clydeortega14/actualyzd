<?php

use Illuminate\Database\Seeder;
use App\FollowupSession;

class FollowupSessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FollowupSession::create(['name' => 'Weekly']);
        FollowupSession::create(['name' => 'Bi-Weekly']);
        FollowupSession::create(['name' => 'Monthly']);
    }
}
