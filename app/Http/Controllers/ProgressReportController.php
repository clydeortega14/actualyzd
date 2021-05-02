<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgressReport;
use App\Http\Requests\ProgressReportRequest;
use App\FollowupSession;

class ProgressReportController extends Controller
{
    public function show(ProgressReport $report)
    {
    	$followup_sessions = FollowupSession::get(['id', 'name']);
    	return view('pages.progress-reports.show', compact('report', 'followup_sessions'));
    }

    public function update(ProgressReport $report, ProgressReportRequest $request)
    {
    	// validate $request
    	$validated = $request->validated();
    	// update progress report data in db
    	$report->update($request->all());
    	// check if report prescription is true
    	if ($report->has_prescription) {
    		// store it in prescriptions table
    	}

    	return redirect()->back()->with('success', 'Progress report successfully updated');
    }
}
