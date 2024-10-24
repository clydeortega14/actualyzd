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

    public function formattedPrice()
    {
    	return number_format($this->price, 2);
    }

    public function clientSubscriptions()
    {
    	return $this->hasMany(ClientSubscription::class, 'package_id');
    }

    public function scopeWithActive($query)
    {
        return $query->where('active', true);
    }
}
