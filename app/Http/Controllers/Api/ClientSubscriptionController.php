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
use Hashids\Hashids;

class ClientSubscriptionController extends Controller
{
    use ClientSubscriptionTrait;

    private $hash_ids;

    public function __construct()
    {
        $this->hash_ids = new Hashids('', 10);
    }

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
            'client_subscription_reference' => ['required', 'string', 'max:255'],
            'action' => ['required', 'string', 'max:255']
        ]);

        if($validator->fails()) return response()->json(['error' => true, 'message' => 'validation errors', 'data' => $validator->errors()->all()], 422);

        $client = Client::where('id', $request->ClientID)->first();

        if(is_null($client)) return response()->json(['error' => true, 'message' => 'Client not found!'], 404);

        $subscription = Package::where('name', $request->subscription)->first();

        if(is_null($subscription)) return response()->json(['error', true, 'message' => 'Subscription not found!'], 404);

        $client_subscription = ClientSubscription::where('client_id', $client->id)
                                ->where('package_id', $subscription->id)
                                ->where('reference_no', $request->client_subscription_reference)
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

            $end_subscription_status = SubscriptionStatus::where('name', 'end')->first();

            $renew_status = SubscriptionStatus::where('name', 'renewed')->first();

            if(is_null($end_subscription_status)) return response()->json(['error' => false, 'message' => 'end subscription status was not found!', 'data' => []], 404);

            if(is_null($renew_status)) return response()->json(['error' => false, 'message' => 'renewed subscription status was not found!', 'data' => []], 404);

            DB::beginTransaction();


            // update the current subscription to end
            $client_subscription->subscription_status_id = $end_subscription_status->id;
            $client_subscription->save();
            
            // create new subscription with a end status, base on the current subscription
            $new_client_subscription = new ClientSubscription;
            $new_client_subscription->client_id = $client_subscription->client_id;
            $new_client_subscription->package_id = $client_subscription->package_id;
            $new_client_subscription->completion_date = $new_expiry_date;
            $new_client_subscription->subscription_status_id = $renew_status->id;
            $new_client_subscription->save();

            $new_client_subscription->reference_no = $this->hash_ids->encode($new_client_subscription->id);
            $new_client_subscription->save();

            // add logs to client subscription history

            // send email to client

            DB::commit();

            return response()->json(['error' => false, 'message' => 'Subscription Renewed!', 'data' => $client_subscription], 200);
        }
    }
}
