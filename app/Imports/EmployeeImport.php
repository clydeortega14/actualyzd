<?php

namespace App\Imports;

use App\User;
use App\Role;
use App\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Http\Traits\Roles\RoleTrait;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;


class EmployeeImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $company_userid;

    public function __construct($company_userid,$role,$company_user)
    {
        $this->company_userid = $company_userid;
        $this->d_pass = 'password';
        $this->role_id = $role;
        $this->userID = $company_user->id;
        
        
        
       
    
       


    }
    public function model(array $row)
    {
        
        $user = new User([
            'client_id'     => $this->company_userid,
                'name'          => $row['name'],
                'email'         => $row['email'],
                'username'      => $row['username'],
                'password'      => Hash::make($this->d_pass),
          ]
        );

        if($user->save()){
            $user->roles()->attach($this->role_id);
            return $user;
        }
    }
    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
