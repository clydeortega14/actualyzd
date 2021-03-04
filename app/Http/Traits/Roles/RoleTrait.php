<?php

namespace App\Http\Traits\Roles;
use App\Role;
use App\Http\Traits\RandomClass;

trait RoleTrait {

	use RandomClass;


	public function roleData(array $data)
    {
        return [
            'name' => $data['name'],
            'display_name' => $data['display_name'],
            'description' => $data['description'],
            'class' => $this->random()
        ];
    }

    public function hasRoles($roles, $user_id)
    {
        foreach($roles as $role)
        {

            \DB::table('role_user')->insert([
                'user_id' => $user_id,
                'role_id' => $role
            ]);
        }
        
    }

    public function rolesQuery()
    {
        return Role::where(function($query){

            if(auth()->user()->hasRole('admin')){

                $query->whereNotIn('name', ['superadmin', 'psychologist']);
            }

        })->with(['permissions'])->get();
    }
}