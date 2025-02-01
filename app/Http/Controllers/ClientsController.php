<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Package;
use App\ClientSubscription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Mail\ClientCreated;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Http\Traits\Clients\Subscriptions\ClientSubscriptions as ClientSubscriptionTrait;
use Hashids\Hashids;
use App\SubscriptionStatus;

class ClientsController extends Controller
{
    use ClientSubscriptionTrait;

    protected $hash_id;

    public function __construct()
    {
        $this->hash_id = new Hashids('', 10);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('created_at', 'desc')->with(['users'])->get();

        return view('pages.superadmin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all())->validate();

        DB::beginTransaction();

            // create client
            $client = $this->storeClient($request->all());

            // send email
            Mail::to($client->email)->send(New ClientCreated($client));

        DB::commit();

        return redirect()->back()->with('success', 'Successfully added a new client!');
    }


    public function validator(array $data){

        return Validator::make($data, [

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:clients'],
            'address' => ['required', 'string', 'max:255'],
            'contact' => ['required']
        ]);
    }


    public function storeClient(array $data)
    {
        return Client::firstOrCreate([
            'name' => $data['name'],
            'email' => $data['email'],
            'postal_address' => $data['address'],
            'contact_number' => $data['contact'],
            'is_active' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        $users = $client->users;

        return view('pages.superadmin.users.index', compact('users', 'client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('pages.superadmin.clients.edit', $this->mainVars($client));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->is_active = !$client->is_active;
        $client->save();

        if(count($client->users) > 0){

            $client->users()->update(['is_active' => $client->is_active ? true : false ]);
        }

        return redirect()->route('clients.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function subscriptions(Client $client)
    {
        $packages = Package::has('services')
                    ->withActive()
                    ->with(['services'])
                    ->get();

        return view('pages.superadmin.clients.subscription', compact('client', 'packages'));
    }

    public function showSubscription(Client $client)
    {

        return view('pages.superadmin.clients.subscriptions.index', $this->mainVars($client));
    }

    public function showClientUsers(Client $client)
    {
        return view('pages.superadmin.clients.users.show', $this->mainVars($client));
    }

    public function mainVars(Client $client)
    {
        $subscriptions = $client->subscriptions()->with(['package', 'status'])->orderBy('created_at', 'desc')->get();

        $employees = $client->users()->whereHas('roles', function($query){
            $query->where('name', 'member');
        })->get();

        $client_subscriptions = $this->getSubscriptions($client)->get();

        return compact('client', 'subscriptions', 'employees', 'client_subscriptions');
    }

    public function addSubscription(Request $request)
    {
        $client = Client::findOrFail($request->client_id);

        if(!$client->is_active) return redirect()->back()->with('error', 'Client must be ACTIVATED first before adding subscription');
        
        $package = Package::where('id',$request->package_id)->first();

        if(is_null($package)) return redirect()->back()->with('error', 'No Package was selected!');

        $completion_date = now()->addMonths($package->no_of_months)->toDateString();

        // Find subscribed status
        $subscribed = SubscriptionStatus::withStatus('subscribed')->first();

        if(is_null($subscribed)) return redirect()->back()->with('error', 'subscribed status not found!');

        // check client subscription to prevent over subscribing.

        $client_subscription = ClientSubscription::where([

            ['client_id', '=', $request->client_id],
            ['package_id', '=', $package->id],
            ['subscription_status_id', '=', $subscribed->id]
        ])
        ->whereNotNull('reference_no')
        ->first();

        if(!is_null($client_subscription)){
            return redirect()->back()->with('error', 'You have existing subscription with the selected package.');
        } else{
            $client_subscription = new ClientSubscription;
            $client_subscription->client_id = $request->client_id;
            $client_subscription->package_id = $package->id;
            $client_subscription->subscription_status_id = $subscribed->id;
            $client_subscription->completion_date = $completion_date;
            $client_subscription->save();

            $client_subscription->reference_no = $this->hash_id->encode($client_subscription->id);
            $client_subscription->save();
        }

        DB::beginTransaction();

        // add client subscription history
        
        

        DB::commit();

        // send email to client

        return redirect()->route('client.show.subscription', $client->id);
    }

    public function clientsWithUsers()
    {
        $clients = Client::where('is_active', true)->whereHas('users', function($query){
            $query->whereHas('roles', function($query2){
                $query2->where('name', 'member');
            });

        })->has('subscription')->with(['users'])->get(['id', 'name']);

        return response()->json($clients);
    }
    public function clientUsers(Client $client)
    {
        $client_users = $client->users()->withRole('member')->get(['id', 'name']);

        return response()->json($client_users);
    }
}
