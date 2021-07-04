<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Client;
use App\Rules\MatchOldPassword;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeImport;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\Roles\RoleTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    use RoleTrait;

    public function profile(User $user)
    {
        return view('pages.users.profile.index', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::where(function($query){

            $auth = auth()->user();

            if($auth){

                $query->whereNotIn('id', [$auth->id]);
            }

            if($auth->hasRole('admin')){

                $query->where('client_id', $auth->client_id);
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
        $clients = Client::get(['id', 'name']);

        return view('pages.superadmin.users.create', compact('roles', 'clients'));
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
            'username' => ['required', 'unique:users', 'max:255'],
            'password' => ['required', 'confirmed']
        ]);


        DB::beginTransaction();

        try {

            // create new user            
            $user = User::create($this->userData($request->toArray()) + [
                'password' => Hash::make($request->password), 
                'client_id' => $request->has('client_id') ? $request->client_id : null 
            ]);

            // check if request has roles provided
            if($request->has('roles')){

                // attach roles
                $this->attachRole($user, $request->roles);
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
        $clients = Client::get(['id', 'name']);

        return view('pages.superadmin.users.create', compact('user', 'roles', 'clients'));
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

        // check if request has roles
        if($request->has('roles')){
            // delete all roles for this user
            $this->deleteRoleUser($user->id);

            // add the new role to user
            $this->attachRole($user, $request->roles);
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
        // Delete avatar/image first before deleting the user
        // Storage::delete($user->avatar);
    }

    public function userData(array $data)
    {
        return [

            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username']

        ];
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'file', 'image'],
            'user' => ['required']
        ]);

        $path = $request->file('photo')->storeAs('avatars', $request->user);

        $user = User::findOrFail($request->user);

        $user->avatar = $path;

        $user->save();

        return response()->json([], 200);
    }

    public function editProfile(User $user)
    {
        if (Auth::id() !== $user->id) return redirect()->route('user.profile', ['user' => Auth::id()]);

        return view('pages.users.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'username' => ['required', 'unique:users,username,' . $user->id, 'max:255'],
            'email' => ['required', 'unique:users,email,' . $user->id],
        ]);

        if ($validator->fails()) return redirect('profile/' . $user->id . '/edit')->withErrors($validator)->withInput();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('user.profile.edit', ['user' => $user->id])->withSuccess('Profile information updated successfully!');
    }

    public function updatePassword(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', 'min:8'],
            'new_confirm_password' => ['required', 'same:new_password'],
        ]);

        if ($validator->fails()) return redirect('profile/' . $user->id . '/edit')->withErrors($validator);

        $user->password = Hash::make($request->new_password);

        $user->save();

        return redirect()->route('user.profile.edit', ['user' => $user->id])->withSuccess('Password updated successfully!');
    }

    public function import_excel(Request $request)
    {

        $this->validate($request,[
            'select_file'    => 'required|mimes:xls,xlsx,csv'
        ]);

        $company_user = auth()->user();
        $company_info = Client::where('id', $company_user->client_id)->first();
        $company_userid = $company_info->id;
        $d_pass = 'password';
        new EmployeeImport($company_userid);

        Excel::import(new EmployeeImport($company_userid),$request->file('select_file'));

        return back()->with('success', 'Excel Data Imported Successfully.');
    }
}
