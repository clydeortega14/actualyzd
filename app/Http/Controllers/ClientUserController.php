<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\Roles\RoleTrait;

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
    public function index()
    {
        $users = User::where(function($query){

            if(auth()->user()){
                $query->whereNotIn('id', [auth()->user()->id]);
            }

            if(auth()->user()->hasRole('admin')){
                // get all users that belongs to this client only
                return $query->where('client_id', auth()->user()->client_id);
            }

        })->with(['roles'])->get();

        return view('pages.clients.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->rolesQuery();

        return view('pages.clients.users.create', compact('roles'));
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

            $user = User::create($this->userData($request->toArray()) + ['password' => Hash::make($request->password) ] + ['client_id' => auth()->user()->hasRole('admin') ? auth()->user()->client_id : null]);

            if($request->has('roles')) $this->attachRoles($user, 'id', $request->roles); // User instance, Role column name, Role column value

        } catch (Exception $e) {

            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();
        return redirect()->route('client.users.index')->with('success', 'New users has been added');
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

    public function update_status(Request $request, $id)
    {
        try {

            if(!auth()->user()->can('can.update.user.status')) return redirect()->back()->with('error', 'You have no permission to edit a user!');

            $user = User::where('id', $id)->where(function($query) {
                (auth()->user()->hasRole('admin')) ? $query->where('client_id', auth()->user()->client_id) : null;
            })->first();

            $data = json_decode($request->data);

            if(!$user) {               
                return response()->json([
                    'error' => true,
                    'message' => 'User not found!'
                ], 401);
            }

            $user->is_active = $data->status;
            $user->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }

        DB::commit();

        return response()->json([
            'error' => false,
            'message' => 'User updated successfully!'
        ], 200);
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

    public function userData(array $data)
    {
        return [

            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username']

        ];
    }
}
