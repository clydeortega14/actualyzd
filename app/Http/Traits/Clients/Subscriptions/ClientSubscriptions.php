<?php


namespace App\Http\Traits\Clients\Subscriptions;

use Illuminate\Http\Request;
use App\Package;
use App\ClientSubscription;
use DB;
use App\Booking;
use App\BookingStatus;

trait ClientSubscriptions {

	public function getSubscriptions($client)
	{
        // $subscription = ClientSubscription::select(
        //     'c.name as ClientName',
        //     'pckg.name as Subscription',
        //     'client_subscriptions.reference_no as Referrence',
        //     DB::raw("DATE_FORMAT(client_subscriptions.completion_date, '%M %d, %Y') as completion_date"),
        //     'srvs.limit as SessionLimit',
        //     'srvs_st.name as SessionType'

        // )
        // ->leftJoin('clients as c', 'c.id', '=', 'client_subscriptions.client_id')
        // ->leftJoin('packages as pckg', 'pckg.id', '=', 'client_subscriptions.package_id')
        // ->join('package_services as srvs', 'srvs.package_id', '=', 'pckg.id')
        // ->leftJoin('session_types as srvs_st', 'srvs_st.id', '=', 'srvs.session_type_id')
        // ->where('client_id', $client->id)
        // ->whereNotNull('client_subscriptions.reference_no')
        // ->groupBy('Referrence', 'SessionType', 'Subscription', 'completion_date', 'SessionLimit')
        // ->orderBy('completion_date');

        $pending_status = BookingStatus::where('name', 'Pending')->first();

		return 
        ClientSubscription::select(
            'id',
            'client_id',
            'package_id',
            'reference_no',
            'completion_date',
            'subscription_status_id',
            
        )
        ->where('client_id', $client->id)
        ->where('completion_date', '>=', now()->toDateString())
        ->with(['package' => function($query) {
            return $query->select('id', 'name', 'description', 'price', 'no_of_months');
        }])
        ->with(['status' => function($query){
            return $query->select('id', 'name');
        }])
        ->with(['bookings' => function($query) use ($pending_status) {
            return $query->select(
                'client_subscription_id',
                DB::raw('count(*) as bookings_count'),
                'session_type_id',
                'package_service_id'
            )
            ->where(function($query2) use ($pending_status){
                if(!is_null($pending_status)){
                    $query2->whereNotIn('status', [$pending_status->id]);
                }
            })
            ->whereNotNull('package_service_id')
            ->groupBy('session_type_id')
            ->with(['sessionType' => function($query2){
                return $query2->select('id', 'name');
            }])
            ->with(['packageService' => function($query2){
                return $query2->select('id','limit');
            }]);
        }])
        ->whereNotNull('reference_no')
        ->whereIn('subscription_status_id', [1, 2])
        ->orderBy('completion_date', 'asc');
	}


    // public function renew(Request $request)
    // {
    //     $client_subscription = ClientSubscription::where('id', $request->client_subscription_id)->first();

    //     if(is_null($client_subscription)) return redirect()->back()->with('error', 'subscription not found');

    //     $client_subscription->completion_date = now()->addMonths($client_subscription->package->no_of_months)->toDateTimeString();
    //     $client_subscription->subscription_status_id = 2;
    //     $client_subscription->save();

    //     // history
    //     $history = $client_subscription->histories()->firstOrCreate([

    //         'amount' => $client_subscription->package->price,
    //         'subscription_status_id' => 2,
    //         'reference_no' => $this->formatReference($client_subscription)
    //     ]);

    //     return redirect()->back()->with('success', 'Successfully Renewed!');
    // }


    public function formatReference($client_subscription)
    {
        return $client_subscription->id.'@'.substr($client_subscription->package->name, 0, 3).'@'.date('mdY', strtotime(now()->toDateString()));
    }

    public function validateSubscriptionUsage(array $data)
    {
        return Validator::make($data, [
            'ClientID' => ['required', 'integer'],
            'ClientSubscriptionID' => ['required', 'integer']
        ]);
    }

    public function findClient($client_id)
    {
        return Client::where('id', $client_id)->first();
    }

    public function findClientSubscription($subscription_id)
    {
        return ClientSubscription::where('id', $subscription_id)->first();
    }
}