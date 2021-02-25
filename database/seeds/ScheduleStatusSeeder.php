<?php

use Illuminate\Database\Seeder;
use App\PsychoSchedStatus;

class ScheduleStatusSeeder extends Seeder
{

	public function __construct()
	{
		$this->statuses = [

			['status' => 'available', 'class' => 'label label-primary'],
			['status' => 'booked', 'class' => 'label label-success'],
			['status' => 'rescheduled', 'class' => 'label label-info'],
			['status' => 'cancelled', 'class' => 'label label-danger']

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
