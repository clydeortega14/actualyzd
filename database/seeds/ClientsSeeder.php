<?php

use Illuminate\Database\Seeder;
use App\Client;
class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->data() as $data){

        	$client = Client::firstOrCreate($data);

            // add atleast One Admin per client
            $user = $client->users()->firstOrCreate([

                'name' => $client->name,
                'email' => $client->email,
                'username' => $client->email,
                'password' => Hash::make('password'),
                'is_active' => true

            ]);

            $user->roles()->attach(3);
        }
    }

    public function data()
    {
    	return [

    		[
    			'name' => 'San Miguel Corporation',
    			'email' => 'info@sanmiguel.com',
    			'number_of_employees' => 50,
    			'contact_number' => '932-32141',
    			'postal_address' => '103 washington street dc',
    		],
    		[
    			'name' => 'Lalamove',
    			'email' => 'info@lalamove.com',
    			'number_of_employees' => 123,
    			'contact_number' => '093284263221',
    			'postal_address' => '48build, 832 street california',
    		],
    		[
    			'name' => 'Concentrix',
    			'email' => 'info@concentrix.com',
    			'number_of_employees' => 250,
    			'contact_number' => '3210-23932',
    			'postal_address' => 'bernardo street 212',
    		],

    	];
    }
}
