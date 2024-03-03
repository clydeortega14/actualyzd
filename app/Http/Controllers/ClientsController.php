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

class ClientsController extends Controller
{
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
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $packages = Package::has('services')->with(['services'])->get();

        return view('pages.superadmin.clients.edit', compact('client', 'packages'));
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
        $packages = Package::has('services')->with(['services'])->get();

        return view('pages.superadmin.clients.subscription', compact('client', 'packages'));
    }

    public function addSubscription(Request $request)
    {

        $client = Client::findOrFail($request->client_id);

        if(!$client->is_active){

            return redirect()->back()->with('error', 'Client must be ACTIVATED first before adding subscription');
        }


        $package = Package::findOrFail($request->package_id);

        $completion_date = now()->addMonths($package->no_of_months)->toDateString();

        DB::beginTransaction();

            $client_subscription = ClientSubscription::firstOrCreate([

                'client_id' => $request->client_id,
                'package_id' => $package->id,
                'completion_date' => $completion_date,
                'subscription_status_id' => 1
            ]);

            $user = User::where('email', $client->email)->first(); 

            if(is_null($user))
            {
                $user = $client->users()->create([
                    'client_id' => $client->id,
                    'name' => $client->name,
                    'email' => $client->email,
                    'username' => $client->email,
                    'password' => Hash::make('password'),
                    'is_active' => true
                ]);
            }


            if(is_null($user->client_id))
            {
                $user->client_id = $client->id;
                $user->save();
            }


            if(count($user->roles) > 0){

                $user->roles()->sync([]);
            }

            // add roles to user
            $user->roles()->attach(3);

        DB::commit();

        return redirect()->route('clients.edit', $client->id);
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
