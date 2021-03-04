<?php

use Illuminate\Database\Seeder;
use App\Http\Traits\RandomClass;

class PermissionSeeder extends Seeder
{
	use RandomClass;
	
	public function __construct()
	{
		$this->permissions = [

			['name' => 'can.create.user', 'display_name' => 'Can Create User'],
			['name' => 'can.update.user.status', 'display_name' => 'Can update user status'],
			['name' => 'can.delete.user', 'display_name' => 'can delete user'],
			['name' => 'can.view.main.dashboard', 'display_name' => 'can view main dashboard'],
			['name' => 'can.view.admin.dashboard', 'display_name' => 'can view admin dashboard'],
			['name' => 'can.add.time', 'display_name' => 'can add time'],
			['name' => 'can.edit.time', 'display_name' => 'can edit time'],
			['name' => 'can.delete.time', 'display_name' => 'can delete time'],
			['name' => 'can.create.schedule', 'display_name' => 'can create schedule'],
			['name' => 'can.edit.schedule', 'display_name' => 'can edit schedule'],
			['name' => 'can.delete.schedule', 'display_name' => 'can delete schedule'],
			['name' => 'can.book.session', 'display_name' => 'can book session'],
			['name' => 'can.reschedule.session', 'display_name' => 'can reschedule session'],
			['name' => 'can.cancel.session', 'display_name' => 'can cancel session'],

		];
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->permissions as $permission){

        	\App\Permission::create([
        		'name' => $permission['name'],
        		'display_name' => $permission['display_name'],
        		'class' => $this->random()
        	]);
        }
    }
}
