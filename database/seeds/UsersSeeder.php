<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Superadmin', 'email' => 'superadmin@psychline.ph', 'password' => Hash::make('password'), 'is_active' => true ]);
    }
}
