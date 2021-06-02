<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\PackageService;
use App\SessionType;
use App\Http\Requests\PackageRequest;
use DB;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::get();
        
        return view('pages.superadmin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.superadmin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'price' => ['required'],
            'no_of_months' => ['required']

        ]);


        DB::beginTransaction();

        try {

            $package = Package::firstOrCreate([

                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'no_of_months' => $request->no_of_months
            ]);
            
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('packages.index')->with('success', 'Package successfully created');
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
        $package = Package::findOrFail($id);

        return view('pages.superadmin.packages.create', compact('package'));
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
        $this->validate($request, [

            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'price' => ['required'],
            'no_of_months' => ['required']

        ]);


        DB::beginTransaction();

        try {

            Package::where('id', $id)->update([

                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'no_of_months' => $request->no_of_months
            ]);
            
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('packages.index')->with('success', 'Package successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            Package::where('id', $id)->delete();
            
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('packages.index')->with('success', 'Package has been deleted!');
    }

    public function services(Package $package)
    {

        $services = $package->services->pluck('session_type_id');

        $session_types = SessionType::whereNotIn('id', $services)->get(['id', 'name']);

        return view('pages.superadmin.packages.services', compact('package', 'session_types'));
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'session_type_id' => ['required'],
            'limit' => ['required']
        ]);

        PackageService::create($request->all());

        return redirect()->back()->with('success', 'Service successfully created');
    }
}
