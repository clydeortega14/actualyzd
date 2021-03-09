<?php

use Illuminate\Database\Seeder;
use App\OptionChoice;

class OptionChoices extends Seeder
{
	public function __construct()
	{
		$this->option_choices = [

			['option' => 1, 'value' => '1', 'display_name' => 'Never'],
			['option' => 1, 'value' => '2', 'display_name' => 'Rare'],
			['option' => 1, 'value' => '3', 'display_name' => 'Sometimes'],
			['option' => 1, 'value' => '4', 'display_name' => 'Often'],
			['option' => 1, 'value' => '5', 'display_name' => 'Always'],
			['option' => 2, 'value' => 'yes', 'display_name' => 'Yes'],
			['option' => 2, 'value' => 'no', 'display_name' => 'No'],

		];
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->option_choices as $choice){
        	OptionChoice::create([

        		'option' => $choice['option'],
        		'value' => $choice['value'],
        		'display_name' => $choice['display_name']
        	]);
        }
    }
}
