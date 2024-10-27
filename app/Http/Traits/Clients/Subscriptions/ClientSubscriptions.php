<?php


namespace App\Http\Traits\Clients\Subscriptions;

use Illuminate\Http\Request;
use App\Package;
use App\ClientSubscription;
use DB;

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


        $bookings_count = DB::table('bookings')
            ->where('client_id', $client->id)
            ->select(
                'id',
                'session_type_id',
                DB::raw('count(*) as total_usage', 
            ))
            ->groupBy('session_type_id')
            ->whereNotNull('client_subscription_id');


		return $client->subscriptions()->select(
            'id',
            'client_id',
            'package_id',
            'reference_no',
            'completion_date',
            'subscription_status_id'
        )
        ->where('completion_date', '>=', now()->toDateString())
        ->with(['package' => function($query) use ($bookings_count) {
            return $query->select('id', 'name', 'description', 'price', 'no_of_months')
                ->with(['services' => function($query2) use ($bookings_count) {
                    return $query2->select('id', 'package_id', 'session_type_id', 'limit')
                            
                            ->with(['sessionType' => function($query3) use ($bookings_count) {
                                return $query3->select('session_types.id', 'session_types.name', 'latest_bookings.total_usage')
                                    ->joinSub($bookings_count, 'latest_bookings', function($join){
                                        $join->on('session_types.id', '=', 'latest_bookings.session_type_id');
                                    });
                            }]);
                }]);
        }])
        ->with(['status' => function($query){
            return $query->select('id', 'name');
        }])
        ->whereNotNull('reference_no')
        ->whereIn('subscription_status_id', [1, 2])
        ->orderBy('completion_date', 'asc');
	}


    public function renew(Request $request)
    {
        $client_subscription = ClientSubscription::where('id', $request->client_subscription_id)->first();

        if(is_null($client_subscription)) return redirect()->back()->with('error', 'subscription not found');

        $client_subscription->completion_date = now()->addMonths($client_subscription->package->no_of_months)->toDateTimeString();
        $client_subscription->subscription_status_id = 2;
        $client_subscription->save();

        // history
        $history = $client_subscription->histories()->firstOrCreate([

            'amount' => $client_subscription->package->price,
            'subscription_status_id' => 2,
            'reference_no' => $this->formatReference($client_subscription)
        ]);

        return redirect()->back()->with('success', 'Successfully Renewed!');
    }


    public function formatReference($client_subscription)
    {
        return $client_subscription->id.'@'.substr($client_subscription->package->name, 0, 3).'@'.date('mdY', strtotime(now()->toDateString()));
    }
}