<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Psychologist;
use App\User;
use App\Http\Traits\Files\FileTrait;

class CareersController extends Controller
{
    use FileTrait;


    public function index()
    {
    	return view('pages.guests.career.index');
    }

    public function store(Request $request)
    {
    	$this->validator($request->all())->validate();

    	DB::beginTransaction();

    	try {

    		// Check If request has file / image
    		if($request->hasFile('resume')){

    			// Validate file
    			$this->validateFile($request->all())->validate();
    			
    			$file = $request->file('resume');

                // filename to store 
                $resume = $this->filenameToStore($file);

                // store file to storage
                $this->storeToStorage($file, 'public/images/resume');


    		}else{

    			$resume = null;
    		}

            
    		// proceed to storing data to db
    		Psychologist::create($this->data($request->all()) + ['resume' => $resume]);
    		
    	} catch (Exception $e) {
    		
    		DB::rollback();

    		return redirect()->back()->with('exception', $e->getMessage());
    	}

    	DB::commit();

    	return redirect()->route('careers.index')->with('success', 'You have successfully submitted your application form');
    }

    protected function validator(array $data)
    {
    	return Validator::make($data, [

    		'firstname' => ['required', 'string', 'max:255'],
    		'middlename' => ['required', 'string', 'max:255'],
    		'lastname' => ['required', 'string', 'max:255'],
    		'email' => ['required', 'email', 'unique:psychologists'],
    		'birthdate' => ['required'],
    		'contact_number' => 'required',
    		'address' => 'required'
    	]);
    }
    protected function validateFile(array $data)
    {
    	// file extension should only be jpeg, png, jpg, bmp
    	// file size should only be 1024 megabytes

        return Validator::make($data, [

            'resume' => ['mimes:jpeg,bmp,png,jpg', 'max:1024']

        ]);
    }

    protected function data(array $data)
    {
    	return [

    		'first_name' => $data['firstname'],
    		'middle_name' => $data['middlename'],
    		'last_name' => $data['lastname'],
    		'email' => $data['email'],
    		'birthdate' => $data['birthdate'],
    		'contact_number' => $data['contact_number'],
    		'address' => $data['address']
    	];
    }
}
