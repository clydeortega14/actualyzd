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

    public function users()
    {
        return $this->hasMany(User::class, 'client_id');
    }

    public function subscription()
    {
        return $this->hasOne(ClientSubscription::class, 'client_id');
    }
}
