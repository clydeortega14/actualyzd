<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestsController extends Controller
{
    public function index()
    {
    	return view('pages.guests.home');
    }
}
