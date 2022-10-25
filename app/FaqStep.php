<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqStep extends Model
{
    protected $table = 'faq_steps';

    protected $fillable = ['faq_id', 'description', 'link', 'filename'];

    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }
}
