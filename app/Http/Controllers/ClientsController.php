<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Package;
use App\ClientSubscription;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::get();

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
        //
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

        $client->update(['is_active' => !$client->is_active ]);

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

    public function addSubscription(Request $request)
    {
        $client = Client::findOrFail($request->client_id);

        if(!$client->is_active){

            return redirect()->back()->with('error', 'Client must be ACTIVATED first before adding subscription');
        }


        $package = Package::findOrFail($request->package_id);
        $completion_date = now()->addMonths($package->no_of_months)->toDateString();

        $client = ClientSubscription::firstOrCreate([

            'client_id' => $request->client_id,
            'package_id' => $package->id,
            'completion_date' => $completion_date,
            'subscription_status_id' => 1
        ]);

        return redirect()->back()->with('success', 'Subscribed successfully');
    }
}
