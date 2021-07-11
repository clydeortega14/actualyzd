<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SessionType;

class SessionTypeController extends Controller
{
    public function allSessions()
    {
    	$session_types = SessionType::get(['id', 'name']);

    	return response()->json($session_types);
    }
}
