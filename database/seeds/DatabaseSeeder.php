<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        // $this->call(RoleUserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(TimeSeeder::class);
        $this->call(ScheduleStatusSeeder::class);
        $this->call(AssessmentCategories::class);
        $this->call(AssessmentOptions::class);
        $this->call(OptionChoices::class);
        $this->call(BookingStatusSeeder::class);
    }
}
