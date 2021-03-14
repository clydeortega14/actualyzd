<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{

	public function __construct()
	{
		$this->users = [

			// ['name' => 'Superadmin', 'email' => 'superadmin@psychline.ph', 'password' => 'password', 'is_active' => true ],
            [
                'name' => 'Administrator', 
                'email' => 'admin@psychline.ph', 
                'username' => 'admin', 
                'password' => 'password', 
                'is_active' => true 
            ],
			// ['name' => 'Psychologist One', 'email' => 'psychologist1@psychline.ph', 'password' => 'password', 'is_active' => true ],
			// ['name' => 'Psychologist Two', 'email' => 'psychologist2@psychline.ph', 'password' => 'password', 'is_active' => true ],
			// ['name' => 'Psychologist Three', 'email' => 'psychologist3@psychline.ph', 'password' => 'password', 'is_active' => true ],
			// ['name' => 'Psychologist Four', 'email' => 'psychologist4@psychline.ph', 'password' => 'password', 'is_active' => true ],
			// ['name' => 'Psychologist Five', 'email' => 'psychologist5@psychline.ph', 'password' => 'password', 'is_active' => true ],
			// ['name' => 'Client Admin', 'email' => 'clientadmin@psychline.ph', 'password' => 'password', 'is_active' => true ],
   //          ['name' => 'Member', 'email' => 'clientmember@psychline.ph', 'password' => 'password', 'is_active' => true ]

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
                'username' => $user['username'],
    			'password' => Hash::make($user['password']), 
    			'is_active' => $user['is_active']
    		]);
    	}
        
    }
}
