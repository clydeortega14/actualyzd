<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Psychologist extends Model
{
    protected $fillable = [

    	'user_id', 'first_name', 'middle_name', 'last_name', 'birthdate', 'contact_number', 'email',
    	'address', 'license_type_id', 'avatar', 'resume'

    ];


    public function user()
    {
    	return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function license_type_id()
    {
    	return $this->hasOne(LicenseType::class, 'license_type_id', 'id');
    }

    public function psychoSchedules()
    {
        return $this->hasMany(PsychologistSchedule::class);
    }
}
