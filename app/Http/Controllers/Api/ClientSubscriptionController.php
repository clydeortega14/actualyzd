<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ClientSubscription;
use App\Client;
use App\Package;
use App\SubscriptionStatus;
use DB;
use App\Http\Traits\Clients\Subscriptions\ClientSubscriptions as ClientSubscriptionTrait;
use Validator;

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

    public function updateClientSubscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ClientID' => ['required', 'integer'],
            'subscription' => ['required', 'string', 'max:255'],
            'action' => ['required', 'string', 'max:255']
        ]);

        if($validator->fails()) return response()->json(['error' => true, 'message' => 'validation errors', 'data' => $validator->errors()->all()], 422);

        $client = Client::where('id', $request->ClientID)->first();

        if(is_null($client)) return response()->json(['error' => true, 'message' => 'Client not found!'], 404);

        $subscription = Package::where('name', $request->subscription)->first();

        if(is_null($subscription)) return response()->json(['error', true, 'message' => 'Subscription not found!'], 404);

        $client_subscription = ClientSubscription::where('client_id', $client->id)
                                ->where('package_id', $subscription->id)
                                ->whereNotNull('reference_no')
                                ->first();
        
        if(is_null($client_subscription)) return response()->json(['error' => true, 'message' => 'Client subscription not found'], 404);

        $subscribed_status = SubscriptionStatus::where('name', 'subscribed')->first();

        if(is_null($subscribed_status)) return response()->json(['error' => true, 'message' => 'Subscribe status not found'], 404);


        if($request->action === "cancel") {

            if($client_subscription->subscription_status_id !== $subscribed_status->id) return response()->json(['error' => true, 'message' => 'client subscription is not in subscribed status, this cannot be process'], 422);

            // find cancelled subscription status
            $cancelled_status = SubscriptionStatus::where('name', 'cancelled')->first();

            if(is_null($cancelled_status)) return response()->json(['error' => true, 'message' => 'Cancelled status not found'], 404);

            DB::beginTransaction();

            $client_subscription->subscription_status_id = $cancelled_status->id;
            $client_subscription->save();


            // add client subscription to history for subscription activity logs

            // sends email to client

            DB::commit();

            return response()->json(['error' => false, 'message' => 'successfully cancelled!', 'data' => $client_subscription], 200);


        }else if($request->action === "renew"){

            // extends completion date
            $new_expiry_date = now()->addMonths($subscription->no_of_months)->toDateString();

            DB::beginTransaction();

            $client_subscription->completion_date = $new_expiry_date;
            $client_subscription->subscription_status_id = $subscribed_status->id;
            $client_subscription->save();

            // add logs to client subscription history

            // send email to client

            DB::commit();

            return response()->json(['error' => false, 'message' => 'Subscription Renewed!', 'data' => $client_subscription], 200);
        }
    }
}
