<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';

    protected $fillable = ['name', 'display_name', 'description', 'class'];

    public function users()
    {
    	return $this->belongsToMany('App\User', 'role_user', 'role_id', 'user_id');
    }

    public function permissions()
    {
    	return $this->belongsToMany('App\Permission', 'permission_role', 'role_id', 'permission_id');
    }
}
