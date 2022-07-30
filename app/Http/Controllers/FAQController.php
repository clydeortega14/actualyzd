<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required']
        ]);

        DB::beginTransaction();

        try {


            $faq = Faq::firstOrCreate([
                'title' => $request->title,
                'description' => $request->description
            ]);


            if($request->has('steps') && count($request->steps['description']) > 0){

                foreach($request->steps['description'] as $index => $step_desc){

                     $faq->steps()->firstOrCreate([

                        'description' => $step_desc,
                        'link' => $request->steps['link'][$index]
                    ]);
                }
            }else{


                return redirect()->back()->with('error', 'must add atleast 2 steps');
            }
            
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }


        DB::commit();

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
}
