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

        	Client::create($data);
        }
    }

    public function data()
    {
    	return [

    		[
    			'name' => 'San Miguel Corporation',
    			'email' => 'sanmiguel@gmail.com',
    			'number_of_employees' => 50,
    			'contact_number' => '932-32141',
    			'postal_address' => '103 washington street dc',
    		],
    		[
    			'name' => 'Lalamove',
    			'email' => 'finance@lalamove.com.ph',
    			'number_of_employees' => 123,
    			'contact_number' => '093284263221',
    			'postal_address' => '48build, 832 street california',
    		],
    		[
    			'name' => 'Concentrix',
    			'email' => 'info@concentrix.com.ph',
    			'number_of_employees' => 250,
    			'contact_number' => '3210-23932',
    			'postal_address' => 'bernardo street 212',
    		],

    	];
    }
}
