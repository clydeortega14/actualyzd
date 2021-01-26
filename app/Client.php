<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
     /**
	  * The attributes that is mass assignable
	  *
	  * @var array
    */

     protected $fillable = [

     	'user_id', 'name', 'number_of_employees', 'contact_number', 'postal_address', 'is_active', 'logo'

     ];

     public function user()
     {
     	return $this->hasOne('App\User', 'user_id');
     }
}
