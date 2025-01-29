<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use App\Http\Traits\handleUsersTraits;
use App\Http\Traits\Roles\RoleTrait;
use App\Http\Traits\Files\FileTrait;

class PsychologistController extends Controller
{

    use handleUsersTraits, RoleTrait, FileTrait;

    public function index()
    {
        $users = User::select(
            'id',
            'name',
            'email',
            'username',
            'is_active',
            'avatar',
            'created_at',

        )
        ->withRole('psychologist')
        ->orderBy('name', 'asc')
        ->get();

        return response()->json($users);
    }

    public function updateStatus(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if(is_null($user)) return response()->json(['error' => true, 'message' => 'User not found!'], 404);


        DB::beginTransaction();

        $user->is_active = !$user->is_active;
        $user->save();

        DB::commit();

        return response()->json(['error' => true, 'message' => 'User status updated!', 'data' => $user], 200);

    }

    public function storePsychologist(Request $request)
    {
        $validator = $this->validateUserData($request);

        if($validator->fails())
        {
            return response()->json([
                'error' => true,
                'message' => 'Validation errors',
                'data' => $validator->errors()->all()
            ]);
        }

        // find role by name
        $find_role = $this->findRoleByName($request->role_name);

        if(is_null($find_role)) return response()->json([
            'error' => true,
            'message' => 'Role not found',
        ], 404);


        DB::beginTransaction();

        $user = $this->createUserData($request);

        $user->roles()->attach($find_role->id);

        $file = $request->file('resume');

        if(is_array($file) && count($file) >= 1){

            $arr_filenames = [];

            foreach($file as $f){
                $filename_to_store = $this->fileNameToStore($f);
                $f->storeAs($request->role_name, $filename_to_store);
                $arr_filenames[] = $filename_to_store;
            }

            $filename = implode(",", $arr_filenames);

        }else{

            $filename_to_store = $this->fileNameToStore($file);
            $file->storeAs($request->role_name, $filename_to_store);
            $filename = $filename_to_store;
        }

        $user->avatar = $filename;
        $user->save();

        DB::commit();

        return response()->json([
            'error' => false,
            'message' => $request->role_name.' has successfully created!',
            'data' => $user
        ], 200);
        
    }
}
