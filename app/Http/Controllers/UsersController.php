<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Client;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\Roles\RoleTrait;

class UsersController extends Controller
{
    use RoleTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where(function($query){

            if(auth()->user()){
                $query->whereNotIn('id', [auth()->user()->id]);
            }

            if(!auth()->user()->hasRole('superadmin')){

                $query->whereNotIn('id', [1]);
            }

            if(auth()->user()->hasRole('admin')){
                // get all users that belongs to this client only
                // $query->whereIn('')
            }

        })->with(['roles'])->get();

        $clients = Client::all();

        return view('pages.superadmin.users.index', compact('users', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->rolesQuery();

        return view('pages.superadmin.users.create', compact('roles'));
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
            'password' => ['required', 'confirmed']
        ]);


        DB::beginTransaction();

        try {

            
            $user = User::create($this->userData($request->toArray()) + ['password' => Hash::make($request->password) ]);

            if($request->has('roles')){

                $this->hasRoles($request->roles, $user->id);
            }

            
        } catch (Exception $e) {
            
            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('users.index')->with('success', 'New users has been added');
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

        $user = User::findOrFail($id);
        $roles = $this->rolesQuery();

        return view('pages.superadmin.users.create', compact('user', 'roles'));
        //
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
        $user = User::findOrFail($id);

        if($request->has('status')){

            $user->update(['is_active' => $request->status ]);

        }else{
            
            $user->update($this->userData($request->toArray()));
        }

        
        // check if request has roles
        if($request->has('roles')){
            // delete all roles for this user
            $this->deleteRoleUser($user->id);

            // add the new role to user
            $this->hasRoles($request->roles, $user->id);
        }else{

            // check if user has existing roles
            if(count($user->roles) > 0){
                // delete all roles belongs to user
                $this->deleteRoleUser($user->id);
            }
        }

        return redirect()->route('users.index')->with('success', 'Successfully Updated');
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

    public function userData(array $data)
    {
        return [

            'name' => $data['name'],
            'email' => $data['email']

        ];
    }
}
