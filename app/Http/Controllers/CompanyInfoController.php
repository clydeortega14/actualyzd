<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Client;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\Roles\RoleTrait;

class CompanyInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $company_user = auth()->user();
        $company_info = Client::where('id', $company_user->client_id)->first();
        


        $users = User::where(function($query){

            $company_user = auth()->user();

            if( $company_user){

                $query->whereNotIn('id', [$company_user->id]);
            }
            
            if($company_user->hasRole('admin')){

                $query->where('client_id', $company_user->client_id);
            }
            

        })->with(['roles'])->get();
      
        return view('pages.company-info.profile.index',compact('company_info','users'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

       
        $company_name = $request->company_name;
        $email = $request->email;
        $contact_number = $request->contact_number;
        $postal_address = $request->postal_address;
        $number_of_employees = $request->number_of_employees;
       

        
        


        
        $client = Client::find($request->client_id);
        $client->name = $company_name;
        $client->email = $email;
        $client->contact_number = $contact_number;
        $client->postal_address = $postal_address;
        $client->number_of_employees = $number_of_employees;
       
        // $client->logo = $imageName;
        if($request->has('file'))
        {
            $this->validate($request,[
                'file'    => 'required|mimes:jpg,png'
            ]);
            
            $client ->update(['logo' => $request->file('file')->store('logo')]);
           

            return back()->with('success', 'Company Logo Successfully Updated.');
        }
        $client->save();
        return back()->with('success', 'Successfully Updated.');


    }
    public function update_companyLogo(Request $request)
    {
        //
        $client = Client::find($request->client_id);
       
        if($request->has('file'))
        {
            $this->validate($request,[
                'file'    => 'required|mimes:jpg,png'
            ]);
            $client ->update(['logo' => $request->file('file')->store('logo')]);
           

            return back()->with('success', 'Company Logo Successfully Updated.');
        }
      
        return back()->with('success', 'Successfully Updated.');


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
}
