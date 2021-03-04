<?php

use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
	public function __construct()
	{
		$this->permission_roles = [
			['permission_id' => 1, 'role_id' => [1, 3] ],
			['permission_id' => 2, 'role_id' => [1, 3] ],
			['permission_id' => 3, 'role_id' => [1, 3] ],
			['permission_id' => 4, 'role_id' => 1 ],
			['permission_id' => 5, 'role_id' => 3 ],
			['permission_id' => 6, 'role_id' => 1 ],
			['permission_id' => 7, 'role_id' => 1 ],
			['permission_id' => 8, 'role_id' => 1 ],
			['permission_id' => 9, 'role_id' => 2 ],
			['permission_id' => 10, 'role_id' => 2 ],
			['permission_id' => 11, 'role_id' => 2 ],
			['permission_id' => 12, 'role_id' => [3,4] ],
			['permission_id' => 13, 'role_id' => [3,4] ],
			['permission_id' => 14, 'role_id' => [3,4] ],
		];
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->permission_roles as $pr)
        {
        	if(is_array($pr['role_id'])){
        		foreach($pr['role_id'] as $rid){
        			$this->create($pr['permission_id'], $rid);
        		}
        	}else{

        		$this->create($pr['permission_id'], $pr['role_id']);
        	}
        }
    }

    public function create($permissionid, $roleid){

    	return \DB::table('permission_role')->insert([
			'permission_id' => $permissionid, 
			'role_id' => $roleid
		]);
    }
}
