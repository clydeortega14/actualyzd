<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function home()
    {
    	return view('pages.members.index');
    }
}
