<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;

class PsychologistController extends Controller
{
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
}
