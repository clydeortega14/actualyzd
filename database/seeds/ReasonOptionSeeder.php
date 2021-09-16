<?php

use Illuminate\Database\Seeder;
use App\ReasonOption;

class ReasonOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $options = [

        ['option_name' => 'There is a Internet Connection Issue'],
        ['option_name' => 'I need to attend something urgent / emergency'],
        ['option_name' => 'I have a conflict schedule'],
        ['option_name' => 'I have technical problems connecting'],
        ['option_name' => 'Others'],

    ];

    public function run()
    {
        foreach($this->options as $option){

            $this->create($option);
        }
    }

    public function create(array $data)
    {
        return ReasonOption::create(['option_name' => $data['option_name'] ]);
    }


}
