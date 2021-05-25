<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssessmentQuestionnaire as Question;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = Question::query();

        if(request()->has('category')){

            $question->where('category', request()->category);
        }

        $questionnaires = $question->with(['category', 'toOption'])->get();

        return $questionnaires;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        Question::create(['category' => $request->category, 'question' => $request->question, 'option' => $request->option ]);

        return redirect()->route('categories.index')->with('success', 'New Question has been added.');
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
        $question = Question::findOrFail($id);

        $quest = $question->where('id', $id)->with(['category', 'toOption'])->get();

        return response()->json($quest[0]);
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
            'category' => ['required'],
            'question' => ['required', 'max:255'],
            'option' => ['required']
        ]);

        Question::where('id', $id)->update(['category' => $request->category, 'question' => $request->question, 'option' => $request->option]);

        return redirect()->route('categories.index')->with('success', 'Updated! Question has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::where('id', $id)->firstOrFail()->delete();

        return redirect()->route('categories.index')->with('success','Deleted! Question has been deleted.');
    }
}
