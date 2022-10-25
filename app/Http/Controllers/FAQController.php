<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use App\FaqStep;
use DB;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = Faq::with(['steps'])->get();

        return view('pages.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('pages.faq.create');
    }

    public function edit(Faq $faq)
    {
        $faq->load(['steps']);
        
        return view('pages.faq.create', compact('faq'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required']
        ]);

        DB::beginTransaction();

        try {

            
            $faq_id = $request->faq_id;

            if($faq_id != null || $faq_id != ''){

                // update
                $faq = Faq::findOrFail($faq_id);
                $faq->title = $request->title;
                $faq->description = $request->description;
                $faq->save();

            }else{

                 $faq = Faq::firstOrCreate([
                    'title' => $request->title,
                    'description' => $request->description
                ]);
            }

            
            $step_id = $request->step_id;

            if($request->has('steps') && count($request->steps['description']) > 0){

                foreach($request->steps['description'] as $index => $step_desc){

                    if($step_id != null || $step_id != ''){
                        
                        // update
                        $faq_step = FaqStep::findOrFail($step_id);
                        $faq_step->description = $step_desc;
                        $faq_step->link = $request->steps['link'][$index];
                        $faq_step->save();

                    }else{

                        $faq->steps()->firstOrCreate([

                            'description' => $step_desc,
                            'link' => $request->steps['link'][$index]
                        ]);

                    }
                     
                }
            }else{

                return redirect()->back()->with('error', 'must add atleast 2 steps');
            }

            DB::commit();
            
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Successfully Submitted!');
        
    }

    public function getAllFaqs()
    {
        $faqs = Faq::with(['steps'])->get();

        return response()->json($faqs);
    }

    public function getFaqSteps(Faq $faq)
    {
        $faq->load(['steps']);

        return response()->json($faq);
    }

    public function search(Request $request)
    {
        $value = $request->search_item;

        $faqs = Faq::query()->where('title', 'LIKE', "%{$value}%")->with(['steps'])->get();

        return response()->json($faqs);
    }
}
