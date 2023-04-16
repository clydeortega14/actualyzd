<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [

        'client_id',
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

    public function admin_users()
    {
        return $this->hasOne(User::class, 'client_id');
    }

    public function subscription()
    {
        return $this->hasOne(ClientSubscription::class, 'client_id');
    }
}
