<?php

use Illuminate\Database\Seeder;

class BookingStatusSeeder extends Seeder
{
	public function __construct()
	{
		$this->statuses = [
			['name' => 'Booked', 'class' => 'badge badge-primary'],
			['name' => 'Completed', 'class' => 'badge badge-success'],
			['name' => 'No Show', 'class' => 'badge badge-secondary'],
			['name' => 'Cancelled', 'class' => 'badge badge-danger'],
			['name' => 'Rescheduled', 'class' => 'badge badge-warning'],
		];
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->statuses as $status){
        	\App\BookingStatus::create([
        		'name' => $status['name'],
        		'class' => $status['class']
        	]);
        }
    }
}
