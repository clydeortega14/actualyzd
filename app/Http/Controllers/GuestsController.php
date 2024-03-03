<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Traits\Clients\ClientTrait;
use App\Http\Traits\Guests\User\GuestUserTrait;

class GuestsController extends Controller
{
    use ClientTrait,
    GuestUserTrait;


    public function index()
    {
    	return view('pages.guests.home');
    }

    public function applyingIndividual()
    {
        return view('pages.guests.individual-customer.index');
    }

    public function contactUs()
    {
    	return view('pages.guests.contact');
    }

    public function clients()
    {
    	return view('pages.guests.clients.index');
    }

    public function store(Request $request)
    {
        // validate
        $this->validator($request->all())->validate();

        // begin transaction
        DB::beginTransaction();

        try {

            // Create new client
            $this->create($request->all());
            
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back('exception', $e->getMessage());
            
        }

        // Commit DB
        DB::commit();

        return redirect()->back()->with('success', 'You successfully submitted your application form and will be verified within 24 hours');

    }
}
