<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\Roles\RoleTrait;
use App\Client;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ClientUserController extends Controller
{
    use RoleTrait;

    public function __construct(Request $request)
    {
        // dd($request->next);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
       
        if($client->is_active == 1)
        {
            $users = $client->users()->with(['roles'])->get();
            $clients = Client::get(['id', 'name','is_active']);
            return view('pages.superadmin.users.index', compact('users', 'client'));
        }
        else{
            return redirect()->back()->with('error','YOU CLIENT IS NOT ALLOWED TO CREATE AND IMPORT USER . PLEASE ACTIVATE FIRST! THANK YOU.');
        }
        // $users = User::where(function($query){

        //     if(auth()->user()){
        //         $query->whereNotIn('id', [auth()->user()->id]);
        //     }

        //     if(auth()->user()->hasRole('admin')){
        //         // get all users that belongs to this client only
        //         return $query->where('client_id', auth()->user()->client_id);
        //     }

        // })->with(['roles'])->get();

        // dd($users);


      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        $roles = $this->rolesQuery();

        $users = $client->users;

        return view('pages.superadmin.users.create', compact('roles', 'users', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => ['required', 'max:255'],
            'email' => ['required', 'unique:users'],
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);


        DB::beginTransaction();

        try {

            $user = User::create($this->userData($request->toArray()) + [
                'password' => Hash::make($request->password),
                'client_id' => $request->client_id
            ]);

            // check if has roles
            if($request->has('roles')){

                // attach role
                $this->attachRole($user, $roles);
            }

        } catch (Exception $e) {

            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();
        return redirect()->back('pages.superadmin.client.users.index')->with('success', 'New users has been added');
    }
    public function addClients(Request $request)
    {
        
        $request->validate([

            'client_name' => ['required', 'string', 'max:255'],
            'Email' => ['required', 'string', 'email', 'max:255'],
            'contact_number' => ['required', 'string', 'max:255'],
            'postal_address' => ['required', 'string', 'max:255'],
        ]);

        $addClient = Client::create([
            'name'         => $request->client_name,
            'email'        => $request->Email,
            'contact_number'  => $request->contact_number,
            'postal_address'  => $request->postal_address,
            'is_active'         => 1,
            'number_of_employees'         => 0,
        ]);

        return redirect()->back()->with('success', 'New Client has been added');

        
        
    }
    public function updateClients(Request $request)
    {
       
        $request->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'contact_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $name = $request->name;
        $email = $request->email;
        $no_emplo = $request->no_of_employees;
        $contact_number = $request->contact_number;
        $address = $request->address;

        $update_client = Client::find($request->id);
        $update_client->name = $name;
        $update_client->email = $email;
        $update_client->number_of_employees = $no_emplo;
        $update_client->contact_number = $contact_number;
        $update_client->postal_address = $address;
        $update_client->save();

        return redirect('/clients')->with('success', 'Client has been Updated');
    }
    public function store_employee(Request $request)
    {
        
        $request->validate([

            'name' => ['required', 'max:255'],
            'email' => ['required', 'unique:users'],
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);


        DB::beginTransaction();

        try {

            $user = User::create($this->userData($request->toArray()) + [
                'password' => Hash::make($request->password),
                'client_id' => $request->client_id
            ]);

            // check if has roles
            if($request->has('roles')){

                // attach role
                $this->attachRole($user, $roles);
            }

        } catch (Exception $e) {

            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();
        return redirect()->back('pages.company-info.profile.index')->with('success', 'New users has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(123567);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            if(!auth()->user()->can('can.edit.user')) return redirect()->back()->with('error', 'You have no permission to edit a user!');

            $user = User::where('id', $id)->where(function($query) {
                    $query->where('id', '<>', auth()->user()->id);
                    if(auth()->user()->hasRole('admin')) {
                        $query->where('client_id', auth()->user()->client_id);
                    }
                })->first();
            
            if(is_null($user)) return redirect()->back()->with('error', 'User not found');
            $roles = $this->rolesQuery();
            
            return view('pages.clients.users.edit', compact('user', 'roles'));
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'User not found');
        }

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
        DB::beginTransaction();

        try {

            if(!auth()->user()->can('can.edit.user')) return redirect()->back()->with('error', 'You have no permission to edit a user!');

            $user = User::where('id', $id)->where(function($query) {
                $query->where('id', '<>', auth()->user()->id);
                (auth()->user()->hasRole('admin')) ? $query->where('client_id', auth()->user()->client_id) : null;
            })->first();

            if(!$user) return redirect()->back()->with('error', 'User not found!');

            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $user->detachRoles($user->roles);
            if($request->has('roles')) $this->attachRoles($user, 'id', $request->roles); // User instance, Role column name, Role column value

        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong!');
        }

        DB::commit();
        return redirect()->route('client.users.index')->with('error', 'User successfully updated!');
    }

    public function updateStatus(Request $request, User $user)
    {
        try {

            $user->update(['is_active' => !$user->is_active ]);

        } catch (\Exception $e) {
            
            DB::rollback();

            return redirect()->back()->with('error', 'Internal Server Error!');
        }

        DB::commit();

        return redirect()->back()->with('success', 'Successfully Updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
       try {

            if(!auth()->user()->can('can.delete.user')) return redirect()->back()->with('error', 'You have no permission to edit a user!');

            $user = User::where('id', $id)->where(function($query) {
                $query->where('id', '<>', auth()->user()->id);
                if(auth()->user()->hasRole('admin')) {
                    $query->where('id', '<>', auth()->user()->id)->where('client_id', auth()->user()->client_id);
                } 
            })
            ->first();

            if(!$user) return response()->json([ 'error' => true, 'message' => 'User not found!'], 404);

            $user->delete();

       } catch (\Exception $e) {

           DB::rollback();
           return response()->json([ 'error' => true, 'message' => 'Something went wrong!', $e->getMessage() ], 500);
       }

       DB::commit();
       return response()->json([ 'error' => true, 'message' => 'User successfully deleted!' ], 200);
       
    }
    public function deleteData($id)
    {
        DB::beginTransaction();
       try {

            if(!auth()->user()->can('can.delete.user')) return redirect()->back()->with('error', 'You have no permission to edit a user!');

            $user = User::where('id', $id)->where(function($query) {
                $query->where('id', '<>', auth()->user()->id);
                if(auth()->user()->hasRole('admin')) {
                    $query->where('id', '<>', auth()->user()->id)->where('client_id', auth()->user()->client_id);
                } 
            })
            ->first();

            if(!$user) return response()->json([ 'error' => true, 'message' => 'User not found!'], 404);

            $user->delete();

       } catch (\Exception $e) {

           DB::rollback();
           return back()->with('error', 'Something went wrong!');
           
       }

       DB::commit();
       
       return back()->with('success', 'User successfully deleted!');
       
    }

    public function userData(array $data)
    {
        return [

            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username']

        ];
    }
}
