<?php

use Illuminate\Database\Seeder;
use App\SessionType;

class SessionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SessionType::create(['name' => 'Individual']);
        SessionType::create(['name' => 'Webinar']);
        SessionType::create(['name' => 'Group Session']);
    }
}
