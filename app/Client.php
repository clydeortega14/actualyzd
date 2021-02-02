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

     	'user_id', 'name', 'email', 'number_of_employees', 'contact_number', 'postal_address', 'is_active', 'logo'

     ];

     public function user()
     {
     	return $this->belongsTo('App\User');
     }

     public function ourLogo()
     {
        return !is_null($this->logo) ? asset('storage/images/'.$this->logo) : asset('admin-bsb/images/empty-image.png');
     }
}
