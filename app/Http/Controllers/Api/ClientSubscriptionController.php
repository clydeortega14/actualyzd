<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ClientSubscription;
use App\Client;
use DB;
use App\Http\Traits\Clients\Subscriptions\ClientSubscriptions as ClientSubscriptionTrait;

class ClientSubscriptionController extends Controller
{
    use ClientSubscriptionTrait;

    public function clientSubscriptions(Request $request)
    {
        $client = Client::where('id', $request->ClientID)->first();

        if(is_null($client)) return response()->json(['error' => true, 'message' => 'Client Not Found'], 404);
        
        $client_subscriptions = $this->getSubscriptions($client)->get();


        return response()->json([
            'error' => true, 
            'message' => 'client subscriptions retrieved!', 
            'data' => $client_subscriptions
        ], 200);
    }
}
