<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OptionChoice as Choice;

use DB;

class OptionChoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'choice_id' => ['required', 'integer'],
            'choice_value' => ['required', 'max:255'],
            'choice_display_name' => ['required', 'max:255']
        ]);

        DB::beginTransaction();

        try {
            Choice::create([
                'option' => $request->choice_id,
                'value' => $request->choice_value,
                'display_name' => $request->choice_display_name
            ]);
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('options.show', $request->choice_id)->with('success', 'New choices has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $choice = Choice::findOrFail($id);

        return response()->json($choice);
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
            'optionchoice_id' => ['required'],
            'choice_value' => ['required', 'max:255'],
            'choice_name' => ['required', 'max:255']
        ]);

        Choice::where([['id', $id], ['option', $request->optionchoice_id]])->update(['value' => $request->choice_value, 'display_name' => $request->choice_name]);

        return redirect()->route('options.show', $request->optionchoice_id)->with('success', 'Updated! Choice has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Choice::where('id', $id)->firstOrFail()->delete();

        return redirect()->route('options.show', $request->cId)->with('success', 'Deleted! Choices has been deleted.');
    }
}
