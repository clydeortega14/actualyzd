<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
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

    public function __construct($company_userid)
    {
        $this->company_userid = $company_userid;
        $this->d_pass = 'password';


    }
    public function model(array $row)
    {
        
    
        return new User([
            'client_id'     => $this->company_userid,
            'name'          => $row['name'],
            'email'         => $row['email'],
            'username'      => $row['username'],
            'password'      => Hash::make($this->d_pass),

            
        ]);
    }
}
