<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;

class BillingController extends Controller
{
    public function clientBilling(Client $client)
    {
        return view('pages.superadmin.clients.billings.index', compact('client'));
    }
}
