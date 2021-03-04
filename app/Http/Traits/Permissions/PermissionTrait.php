<?php

namespace App\Http\Traits\Permissions;
use App\Permission;

trait PermissionTrait {

	public function permissions()
	{
		return Permission::all();
	}

	public function arrPermissions($permissions, $roleid)
	{
		foreach($permissions as $permission)
		{
			\DB::table('permission_role')->insert(['permission_id' => $permission, 'role_id' => $roleid ]);
		}
	}

	public function deletePermissionRole($roleid)
	{
		return \DB::table('permission_role')->where('role_id', $roleid)->delete();
	}
}