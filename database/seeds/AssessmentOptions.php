<?php

use Illuminate\Database\Seeder;
use App\AssessmentOption;

class AssessmentOptions extends Seeder
{
	public function __construct()
	{
		$this->options = [

			['name' => 'Option A'],
			['name' => 'Option B'],
			['name' => 'Option C']
		];
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->options as $option){

        	AssessmentOption::create([
	        	'name' => $option['name']
	        ]);
        }
    }
}
