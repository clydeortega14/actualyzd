<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Psychologist;
use App\User;
use Illuminate\Support\Facades\Hash;

class PsychologistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $psychologists = Psychologist::with('user')->get();

        return view('pages.superadmin.psychologists.index', compact('psychologists'));
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

    public function activate(Request $request)
    {
        $psychologist = Psychologist::findOrFail($request->psychologist_id);

        DB::beginTransaction();

        try {

            if(is_null($psychologist->user_id)){

                $user = User::firstOrCreate([
                    'name' => $psychologist->full_name, 
                    'email' => $psychologist->email, 
                    'password' => Hash::make('123456'), 
                    'is_active' => true 
                ]);

            }else{

                $user = $psychologist->user;
            }
            
        } catch (Exception $e) {

            DB::rollback();

            return response()->json(['status' => 'exception', 'message' => $e->getMessage() ], 500);
            
        }

        DB::commit();

        return response()->json(['status' => 'success', 'message' => 'successfully ']);

    }
}
