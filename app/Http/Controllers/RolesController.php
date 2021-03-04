<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use DB;
use App\Http\Traits\Roles\RoleTrait;
use App\Http\Traits\Permissions\PermissionTrait;

class RolesController extends Controller
{
    use RoleTrait, PermissionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where(function($query){
            $user = auth()->user();
            if($user->hasRole('admin')){
                $query->whereNotIn('name', ['superadmin', 'psychologist']);
            }
        })->with(['permissions'])->get();

        return view('pages.superadmin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissions();

        return view('pages.superadmin.roles.create', compact('permissions'));
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
            'name' => ['required', 'max:255']
        ]);

        DB::beginTransaction();

        try {

            $role = Role::create($this->roleData($request->toArray() ));

            // check if request has permissions
            if($request->has('permissions')){
                $this->arrPermissions($request->permissions, $role->id);
            }
            
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }

        DB::commit();

        return redirect()->route('roles.index')->with('success', 'Successfully Created');
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
        $role = Role::findOrFail($id);
        $permissions = $this->permissions();
        return view('pages.superadmin.roles.create', compact('role', 'permissions'));
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
            $role = Role::findOrFail($id);
            $role->update([
                'display_name' => $request->display_name,
                'description' => $request->description
            ]);

            // check if request has permission
            if($request->has('permissions')){
                // delete old permission from this role
                $this->deletePermissionRole($role->id);

                // add the new permissions
                $this->arrPermissions($request->permissions, $role->id);
            }else{

                // Check if role has permissions
                if(count($role->permissions) > 0){
                    // delete old permission from this role
                    $this->deletePermissionRole($role->id);
                }
            }


        } catch (Exception $e) {
            DB::rollback();

            return $e;
        }

        DB::commit();

        return redirect()->route('roles.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
  P   * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
