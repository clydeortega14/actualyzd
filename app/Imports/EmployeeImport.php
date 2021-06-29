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
    public function model(array $row)
    {
        return new User([
            'client_id'     => $row['client_id'],
            'name'          => $row['name'],
            'email'         => $row['email'],
            'username'      => $row['username'],
            'password'      => Hash::make($row['password']),

            
        ]);
    }
}
