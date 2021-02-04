<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Psychologist extends Model
{
    protected $fillable = [

    	'user_id', 'first_name', 'middle_name', 'last_name', 'birthdate', 'contact_number', 'email',
    	'address', 'avatar', 'resume'

    ];


    public function user()
    {
    	return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function license_type_id()
    {
    	return $this->hasOne(LicenseType::class, 'license_type_id', 'id');
    }

    public function psychoSchedules()
    {
        return $this->hasMany(PsychologistSchedule::class);
    }

    public function getMyAvatarAttribute()
    {
        return !is_null($this->avatar) ? asset('storage/images/avatars/'.$this->avatar) :  asset('admin-bsb/images/user.png');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->middle_name.' '.$this->last_name;
    }
}
