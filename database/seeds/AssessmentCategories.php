<?php

use Illuminate\Database\Seeder;
use App\AssessmentCategory;

class AssessmentCategories extends Seeder
{
	public function __construct()
	{
		$this->categories = [

			['name' => 'Mental Challenges'],
			['name' => 'Work Issues'],
			['name' => 'Personal Problems']

		];
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->categories as $category){

        	AssessmentCategory::create(['name' => $category['name']]);
        }
    }
}
