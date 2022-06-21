<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Notifications\CustomResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password', 'api_token', 'is_active', 'client_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
      *
      * @return App\Client
    */

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function schedules()
    {
        return $this->hasMany('App\PsychologistSchedule', 'psychologist', 'id');
    }

    public function psychologist()
    {
        return $this->belongsTo('App\Psychologist');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }
    public function bookings()
    {
        // return $this->belongsToMany('App\Booking', 'session_participants', 'participant', 'booking_id');
        return $this->hasMany('App\Booking', 'booked_by', 'id');
    }

    public function activities()
    {
        return $this->hasMany(ActivityLog::class, 'user_id', 'id');
    }
    public function progressReports()
    {
        return $this->hasMany(ProgressReport::class, 'counselee', 'id');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }
}
