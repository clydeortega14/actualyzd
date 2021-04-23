<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
    	'name', 
    	'email', 
    	'number_of_employees', 
    	'contact_number', 
    	'postal_address', 
    	'is_active', 
    	'logo'
    ];
}
