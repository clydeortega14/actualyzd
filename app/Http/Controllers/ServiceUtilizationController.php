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
    	$clients = Client::where('is_active', true)->has('subscription')->with(['subscription'])->get();

    	$session_types = SessionType::has('services')->get();

    	$services = [];

    	foreach($session_types as $session_type){

    		$services[] = [
                'id' => $session_type->id,
    			'name' => $session_type->name,
    			'limit' => $session_type->services->sum('limit'),
    			'bookings' => $session_type->bookings

    		];
    	}

    	return [

            'clients' => $clients,
            'services' => $services

        ];
    }

    public function clientServices($id)
    {
        $client = Client::findOrFail($id);

        $client_subscription = ClientSubscription::where('client_id', $client->id)
            ->with(['package.services'])
            ->first();

        $services = $client_subscription->package->services->map(function($service){

            return [
                'id' => $service->session_type_id,
                'name' => $service->sessionType->name,
                'limit' => $service->limit,
                'bookings' => $service->sessionType->bookings
            ];

        });

        return response()->json($services);
    }
}
