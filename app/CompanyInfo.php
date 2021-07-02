<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    //

    protected $table = 'company_info';

    protected $fillable = [
        
    	'name', 
    	'email',  
    	'contact_number', 
    	'address', 
    	'is_active', 
    	'logo'
    ];
}
