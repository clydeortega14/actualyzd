<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ReasonOption;

class ReasonController extends Controller
{
    public function index()
    {
        $reasons = ReasonOption::get(['id', 'option_name']);

        return response()->json($reasons);
    }
}
