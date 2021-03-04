<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use DB;
use App\Http\Traits\Roles\RoleTrait;

class RolesController extends Controller
{
    use RoleTrait;
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
        return view('pages.superadmin.roles.create');
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

            Role::create($this->roleData($request->toArray() ));
            
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
        return view('pages.superadmin.roles.create', compact('role'));
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
        //
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
