<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionViewController extends Controller
{
    public function calendar()
    {
        return view('pages.schedules.calendar');
    }
}
