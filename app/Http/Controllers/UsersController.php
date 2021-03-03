<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereHas('roles', function($q){

            // Must not include user with role superadmin in the list
            $q->whereNotIn('name', ['superadmin']);

        })->with(['roles'])->get();

        return view('pages.superadmin.users.index', compact('users'));
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

        DB::table('role_user')->where('user_id', $user->id)->delete();
        if($request->has('roles')){
            $this->hasRoles($request->roles, $user->id);
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


    public function hasRoles($roles, $user_id)
    {
        foreach($roles as $role)
        {

            DB::table('role_user')->insert([
                'user_id' => $user_id,
                'role_id' => $role
            ]);
        }
        
    }

    public function rolesQuery()
    {
        return Role::where(function($query){

            if(auth()->user()->hasRole('admin')){

                $query->whereNotIn('name', ['superadmin', 'psychologist']);
            }

        })->with(['permissions'])->get();
    }

    public function userData(array $data)
    {
        return [

            'name' => $data['name'],
            'email' => $data['email']

        ];
    }
}
