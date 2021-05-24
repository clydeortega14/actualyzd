<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssessmentOption as Option;

use DB;

class AssessmentOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::with(['choices'])->get();

        return view('pages.superadmin.assessments.options.index', compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'assessment_option' => ['required','max:255']
        ]);

        DB::beginTransaction();

        try {

            Option::create(['name' => $request->assessment_option]);

        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('options.index')->with('success', 'New option has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $option = Option::findOrFail($id);

        return view('pages.superadmin.assessments.options.choices.index', compact('option'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $option = Option::findOrFail($id);

        return response()->json($option);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'option_id' => ['required'],
            'option_name' => ['required', 'max:255']
        ]);

        Option::where('id', $id)->update(['name' => $request->option_name]);

        return redirect()->route('options.index')->with('success', 'Updated! Option successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Option::where('id', $id)->firstOrFail()->delete();

        return redirect()->route('options.index')->with('success', 'Deleted! An Option has been deleted.');
    }
}
