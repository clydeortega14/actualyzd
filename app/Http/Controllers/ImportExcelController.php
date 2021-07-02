<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Client;
use DB;
use Excel;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\Roles\RoleTrait;

class ImportExcelController extends Controller
{
    function idex()
    {
        $users = User::where(function($query){

            $company_user = auth()->user();

            if( $company_user){

                $query->whereNotIn('id', [$company_user->id]);
            }

            if($company_user->hasRole('admin')){

                $query->where('client_id', $company_user->client_id);
            }

        })->get();
         dd($users);
    }


}
