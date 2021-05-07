<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientSubscription;
use App\SessionType;
use DB;

class ServiceUtilizationController extends Controller
{
    public function dashboard()
    {
    	$clients = Client::where('is_active', true)->has('subscription')->get();

    	$session_types = SessionType::has('services')->get();

    	$services = [];

    	foreach($session_types as $session_type){

    		$services[] = [

    			'name' => $session_type->name,
    			'limit' => $session_type->services->sum('limit'),
    			'bookings' => $session_type->bookings

    		];
    	}

    	return $services;
    }
}
