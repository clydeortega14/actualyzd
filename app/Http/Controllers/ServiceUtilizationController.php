<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientSubscription;
use App\SessionType;
use App\Booking;
use DB;

class ServiceUtilizationController extends Controller
{
    public function dashboard(Request $request)
    {
    	$clients = Client::where('is_active', true)->has('subscription')->get(['id', 'name']);

        // if there is client id provided
        if($request->has('client')){

            // services of the client
            $services = $this->serviceWithClient($request->client);

        }else{

            // all services
            $services = $this->allServices();
        }

        $bookings = $this->countBookings();

    	return [
            'clients' => $clients,
            'services' => $services,
            'bookings' => $bookings
        ];
    }

    public function serviceWithClient($client_id)
    {
        $client = Client::findOrFail($client_id);

        $client_subscription = ClientSubscription::where('client_id', $client->id)
            ->with(['package.services'])
            ->first();

        return $client_subscription->package->services->map(function($service) use ($client_id){

            return [
                'id' => $service->session_type_id,
                'name' => $service->sessionType->name,
                'limit' => $service->limit,
                'bookings' => $service->sessionType->bookings()->where('client_id', $client_id)->get()
            ];

        });
    }

    public function allServices()
    {
        $session_types = SessionType::has('services')->get();

        return $session_types->map(function($session_type){
            return [
                'id' => $session_type->id,
                'name' => $session_type->name,
                'limit' => $session_type->services->sum('limit'),
                'bookings' => $session_type->bookings
            ];
        });
    }

    public function countBookings()
    {
        $bookings = Booking::where(function($query){

            if(request()->has('client')){

                $query->where('client_id', request()->get('client'));
            }

        })->select(DB::raw('count(*) as booking_count, status'))
        ->groupBy('status')
        ->with(['toStatus'])
        ->get();


        return $bookings;
    }
}
