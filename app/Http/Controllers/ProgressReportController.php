<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgressReport;
use App\Http\Requests\ProgressReportRequest;
use App\FollowupSession;
use App\Http\Traits\ProgressReportTrait;
use DB;
use App\Medication;
use App\Booking;

class ProgressReportController extends Controller
{
    use ProgressReportTrait;

    public function index()
    {
        $reports = $this->getReports();

        return view('pages.psychologists.index', compact('reports'));
    }

    public function index2()
    {
        $reports = $this->getReports();

        return view('pages.progress-reports.index', compact('reports'));
    }

    public function show(Booking $booking)
    {
    	$followup_sessions = FollowupSession::get(['id', 'name']);
    	return view('pages.progress-reports.show', compact('booking', 'followup_sessions'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'main_concern' => ['required'],
            'initial_assessment' => ['required'],
            'followup_session' => ['required'],
            'has_prescription' => ['required'],
            'treatment_goal' => ['required']
        ]);

        DB::beginTransaction();

        try {

            $report = ProgressReport::create([

                'booking_id' => $request->booking_id,
                'main_concern' => $request->main_concern,
                'initial_assessment' => $request->initial_assessment,
                'followup_session' => $request->followup_session,
                'has_prescription' => $request->has_prescription === "true" ? 1 : 0,
                'treatment_goal' => $request->treatment_goal
            ]);

            if($request->has_prescription == "true" || $request->has('medication')){

                $this->validate($request, [
                    'medication' => ['required']
                ]);

                Medication::create(['report_id' => $report->id, 'medication' => $request->medication]);
            }
            
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        
        DB::commit();

    	return redirect()->back()->with('success', 'Progress report successfully updated');
    }
}
