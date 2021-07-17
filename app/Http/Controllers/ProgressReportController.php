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
use App\AssessmentCategory;
use App\User;

class ProgressReportController extends Controller
{
    use ProgressReportTrait;

    public function __construct()
    {
        $this->editMode = false;
    }

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

    public function create(Booking $booking)
    {
        $edit_mode = false;
        $followup_sessions = FollowupSession::get(['id', 'name']);
        $categories = AssessmentCategory::has('questionnaires')->with('questionnaires')->get(['id', 'name']);
        return view('pages.progress-reports.create', compact('booking', 'followup_sessions', 'categories', 'edit_mode'));
    }

    public function show(Booking $booking)
    {
    	$followup_sessions = FollowupSession::get(['id', 'name']);
        $categories = AssessmentCategory::has('questionnaires')->with('questionnaires')->get(['id', 'name']);
    	return view('pages.progress-reports.show', compact('booking', 'followup_sessions', 'categories'));
    }

    public function store(Request $request)
    {
    	$this->validateReport($request);

        DB::beginTransaction();

        try {

            $report = ProgressReport::firstOrCreate([

                'booking_id' => $request->booking_id,
                'main_concern' => $request->main_concern,
                'initial_assessment' => $request->initial_assessment,
                'followup_session' => $request->followup_session,
                'has_prescription' => $request->has_prescription === "1" ? 1 : 0,
                'treatment_goal' => $request->treatment_goal,
                'assignee' => auth()->user()->id
            ]);

            $this->manageMedication($request, $report);

            // update booking status to complete
            $report->booking()->update(['status' => 2]);
            
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        
        DB::commit();

    	return redirect()->route('progress-reports.show', $report->booking->id)->with('success', 'Progress report successfully created');
    }
    public function edit(Booking $booking)
    {
        $edit_mode = true;
        $followup_sessions = FollowupSession::get(['id', 'name']);
        $categories = AssessmentCategory::has('questionnaires')->with('questionnaires')->get(['id', 'name']);
        return view('pages.progress-reports.create', compact('booking', 'followup_sessions', 'categories', 'edit_mode'));
    }
    public function update(Request $request, ProgressReport $report)
    {
        $this->validateReport($request);

        DB::beginTransaction();

        try {
            $report->booking()->update(['main_concern' => $request->category]);

            $this->manageMedication($request, $report);

            $report->update([
                'booking_id' => $request->booking_id,
                'main_concern' => $request->main_concern,
                'initial_assessment' => $request->initial_assessment,
                'followup_session' => $request->followup_session,
                'has_prescription' => $request->has_prescription === "1" ? 1 : 0,
                'treatment_goal' => $request->treatment_goal,
            ]);

            if($report->booking->status != 2){
                $report->booking()->update(['status' => 2]);
            }

        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('progress.report.create-for-booking', $report->booking->id)->with('success', 'Progress Report has successfully updated');
    }

    protected function manageMedication($request, $report)
    {
        if($request->has_prescription == "1" || $request->has('medication')){

            $this->validate($request, [
                'medication' => ['required']
            ]);

            if(!is_null($report->hasMedication)){

                $report->hasMedication()->update(['medication' => $request->medication ]);

            }else{

                Medication::firstOrCreate(['report_id' => $report->id, 'medication' => $request->medication]);
            }

        }
    }

    protected function validateReport($request)
    {
        return $this->validate($request, [
            'category' => ['required'],
            'main_concern' => ['required'],
            'initial_assessment' => ['required'],
            'followup_session' => ['required'],
            'has_prescription' => ['required'],
            'treatment_goal' => ['required']
        ]);
    }

    public function assignReport(Request $request, $id)
    {
        $report = ProgressReport::where('id', $id)->update(['assignee' => $request->assignee ]);
        return response()->json(['success' => true, 'message' => 'Progress report has been assigned'], 200);
    }

    public function getAssignees()
    {
        $assignees = User::withRole('psychologist')->get();

        return response()->json($assignees);
    }
}
