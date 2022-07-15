<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        return view('pages.faq.index');
    }

    public function create()
    {
        return view('pages.faq.create');
    }
}
