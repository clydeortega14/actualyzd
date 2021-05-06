<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = ['name', 'description', 'price', 'no_of_months', 'active'];

    public function services()
    {
    	return $this->hasMany(PackageService::class, 'package_id');
    }
}
