<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home2');
    }

    public function serviceUtilizationDashboard()
    {
        return view('pages.service-utilization-dashboard');
    }

    public function setUps()
    {
        return view('pages.superadmin.set-ups');
    }
    public function accessRights()
    {
        return view('pages.superadmin.access-rights');
    }
    public function assessments()
    {
        return view('pages.superadmin.assessments');
    }
}
