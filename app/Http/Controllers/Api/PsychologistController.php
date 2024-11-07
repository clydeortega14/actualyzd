<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class PsychologistController extends Controller
{
    public function index()
    {
        $users = User::select(
            'id',
            'name',
            'email',
            'is_active',
            'avatar',
            'created_at',

        )
        ->withActive()
        ->withRole('psychologist')
        ->orderBy('name', 'asc')
        ->get();

        return response()->json($users);
    }
}
