<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($invoice_no)
    {
        return view('pages.superadmin.clients.payments.index');
    }

    public function show()
    {
        return view('pages.superadmin.clients.payments.show');
    }
}
