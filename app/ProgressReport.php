<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    protected $table = 'progress_reports';
    protected $fillable = 
    	[
    		'booking_id',
    		'main_concern',
    		'has_prescription',
    		'initial_assessment',
    		'followup_session',
    		'treatment_goal',
            'assignee'
    	];

    public function booking()
    {
    	return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function followupSession()
    {
    	return $this->belongsTo(FollowupSession::class, 'followup_session');
    }
    public function medication()
    {
        return $this->hasOne(Medication::class, 'id');
    }
    public function toAssignee()
    {
        return $this->belongsTo(User::class, 'assignee');
    }
}
