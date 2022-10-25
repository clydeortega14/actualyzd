<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';

    protected $fillable = ['title', 'description'];

    public function steps()
    {
        return $this->hasMany(FaqStep::class);
    }
}
