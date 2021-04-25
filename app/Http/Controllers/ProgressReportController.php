<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgressReport;

class ProgressReportController extends Controller
{
    public function show(ProgressReport $report)
    {
    	return view('pages.progress-reports.show', compact('report'));
    }
}
