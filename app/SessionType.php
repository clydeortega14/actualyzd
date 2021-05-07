<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    protected $table = 'session_types';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function services()
    {
    	return $this->hasMany(PackageService::class, 'session_type_id');
    }

    public function bookings()
    {
    	return $this->hasMany(Booking::class, 'session_type_id');
    }
}
