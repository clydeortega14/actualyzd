<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssessmentCategory as Category;
use App\AssessmentOption as option;

use DB;

class AssessmentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $options = Option::with(['choices'])->get();

        return view('pages.superadmin.assessments.categories.index', compact('categories', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.superadmin.assessments.categories.create');
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
            'assessment_category' => ['required', 'max:255']
        ]);

        DB::beginTransaction();

        try {
            Category::create([
                'name' => $request->assessment_category
            ]);
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());

        }

        DB::commit();

        return redirect()->route('categories.index')->with('success', 'New category has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.bookings.components.questionnaire', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return response()->json($category);
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
            'category_name' => ['required', 'max:255']
        ]);

        Category::where('id', $id)->update(['name' => $request->category_name]);

        return redirect()->route('categories.index')->with('success', 'Updated! Category successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id', $id)->firstOrFail()->delete();

        return redirect()->route('categories.index')->with('success', 'Deleted! A Category has been deleted.');
    }

    public function questionnaires()
    {
        $categories = Category::has('questionnaires')->with(['questionnaires.toOption.choices'])->get();

        return response()->json($categories);
    }
}
