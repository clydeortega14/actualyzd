<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageService extends Model
{
    protected $table = 'package_services';

    protected $fillable = ['package_id', 'session_type_id', 'limit', 'completion_date'];

    public function package()
    {
    	return $this->belongsTo(Package::class, 'package_id');
    }

    public function sessionType()
    {
    	return $this->belongsTo(SessionType::class, 'session_type_id');
    }
}
