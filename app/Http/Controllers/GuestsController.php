<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Traits\Clients\ClientTrait;

class GuestsController extends Controller
{
    use ClientTrait;


    public function index()
    {
    	return view('pages.guests.home');
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
