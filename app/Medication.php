<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $table = 'client_medications';
    protected $fillable = ['report_id', 'medication'];

    public function report()
    {
    	return $this->belongsTo(ProgressReport::class, 'report_id');
    }
}
