<?php

namespace App\Exports;

use App\User;
use App\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmployeeExport implements FromView,ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($users,$company_info)
    {
        $this->users = $users;
        $this->comapny_info = $company_info;
       

    }

    public function view(): View
    {
        return view('pages.exports.employee_export',[
            'users' => $this->users,
            'company' => $this->comapny_info
        ]);
    }
}
