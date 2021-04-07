<?php

use Illuminate\Database\Seeder;
use App\PsychoSchedStatus;

class ScheduleStatusSeeder extends Seeder
{

	public function __construct()
	{
		$this->statuses = [

			['status' => 'available', 'class' => 'badge badge-primary'],
			['status' => 'booked', 'class' => 'badge badge-info'],
			['status' => 'rescheduled', 'class' => 'badge badge-warning'],
			['status' => 'cancelled', 'class' => 'badge badge-danger']

		];
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->statuses as $status)
        {
        	PsychoSchedStatus::create(['status' => $status['status'], 'class' => $status['class'] ]);
        }
    }
}
