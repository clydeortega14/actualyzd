<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseType extends Model
{
    protected $fillable = [

    	'name'
    ];

    public $timestamps = false;

    public function psychologist()
    {
    	return $this->belongsToMany(Psychologist::class, 'license_type_id');
    }
}
