<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Http\Traits\Roles\RoleTrait;

class RolesSeeder extends Seeder
{
    use RoleTrait;

	public function __construct()
	{
		$this->roles = [

			['name' => 'superadmin', 'display_name' => 'Superadmin'],
			['name' => 'psychologist', 'display_name' => 'Psychologist'],
			['name' => 'admin', 'display_name' => 'Admin'],
			['name' => 'member', 'display_name' => 'Member'],

		];
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->roles as $role)
        {
        	Role::create([
                'name' => $role['name'],
                'display_name' => $role['display_name'],
                'class' => array_rand($this->classes())
            ]);
        }
    }
}
