<?php

use Illuminate\Database\Seeder;
use App\TimeList;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function __construct()
   	{
   		$this->lists = [

   			['from' => '07:00:00', 'to' => '08:00:00'],
    		['from' => '08:00:00', 'to' => '09:00:00'],
    		['from' => '09:00:00', 'to' => '10:00:00'],
    		['from' => '10:00:00', 'to' => '11:00:00'],
    		['from' => '11:00:00', 'to' => '12:00:00'],
    		['from' => '13:00:00', 'to' => '14:00:00'],
    		['from' => '14:00:00', 'to' => '15:00:00'],
    		['from' => '15:00:00', 'to' => '16:00:00'],
    		['from' => '16:00:00', 'to' => '17:00:00'],
    		['from' => '17:00:00', 'to' => '18:00:00']

   		];
   	}

    public function run()
    {
        foreach($this->lists as $time)
        {
        	TimeList::create(['from' => $time['from'], 'to' => $time['to'] ]);
        }
    }


}
