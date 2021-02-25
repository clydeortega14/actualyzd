<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{

	public function __construct()
	{
		$this->users = [

			['name' => 'Superadmin', 'email' => 'superadmin@psychline.ph', 'password' => 'password', 'is_active' => true ],
			['name' => 'Psychologist One', 'email' => 'psychologist1@psychline.ph', 'password' => 'password', 'is_active' => true ],
			['name' => 'Psychologist Two', 'email' => 'psychologist2@psychline.ph', 'password' => 'password', 'is_active' => true ],
			['name' => 'Psychologist Three', 'email' => 'psychologist3@psychline.ph', 'password' => 'password', 'is_active' => true ],
			['name' => 'Psychologist Four', 'email' => 'psychologist4@psychline.ph', 'password' => 'password', 'is_active' => true ],
			['name' => 'Psychologist Five', 'email' => 'psychologist5@psychline.ph', 'password' => 'password', 'is_active' => true ],
			['name' => 'Client', 'email' => 'client@psychline.ph', 'password' => 'password', 'is_active' => true ]

		];
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach($this->users as $user){

    		User::create([
    			'name' => $user['name'], 
    			'email' => $user['email'], 
    			'password' => Hash::make($user['password']), 
    			'is_active' => $user['is_active']
    		]);
    	}
        
    }
}
