<?php


namespace App\Http\Traits\Clients\Subscriptions;

use Illuminate\Http\Request;
use App\Package;
use App\ClientSubscription;

trait ClientSubscriptions {

	public function getSubscriptions($client)
	{
		return $client->subscriptions()->select(
            'id',
            'client_id',
            'package_id',
            'completion_date',
            'subscription_status_id'
        )
        ->with(['package' => function($query){
            return $query->select('id', 'name', 'description', 'price', 'no_of_months')
                ->with(['services' => function($query2){
                    return $query2->select('id', 'package_id', 'session_type_id', 'limit')
                            ->with(['sessionType' => function($query3){
                                return $query3->select('id', 'name');
                            }]);
                }]);
        }])
        ->whereIn('subscription_status_id', [1, 2]);
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