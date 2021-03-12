<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeList;

class TimeListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timelists = TimeList::get();
        return view('pages.superadmin.timelists.index', compact('timelists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.superadmin.timelists.create');
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
            'from' => ['required'],
            'to' => ['required']
        ]);

        TimeList::create($this->requestData());

        return redirect()->route('time-lists.index')->with('success', 'Successfully Created');
    }

    protected function requestData()
    {
        return [
            'from' => request()->from,
            'to' => request()->to
        ];
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
        $time = Timelist::findOrFail($id);

        return view('pages.superadmin.timelists.create', compact('time'));
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
            'from' => ['required'],
            'to' => ['required']
        ]);

        TimeList::where('id', $id)->update($this->requestData());

        return redirect()->route('time-lists.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TimeList::where('id', $id)->delete();

        return response()->json(['status' => true, 'message' => 'Deleted! data cannot be restore anymore']);
    }
}
