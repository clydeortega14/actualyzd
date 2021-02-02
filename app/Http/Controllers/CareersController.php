<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Psychologist;
use App\Files\FileManager;

class CareersController extends Controller
{
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
    			$this->validateFile();
    			
    			$file_manager = new FileManager($request->file('resume'));

    			// Store file to storage
    			$file_manager->storeToStorage('public/images');

    			$resume = $file_manager->fileToStore();

    		}else{

    			$resume = null;
    		}


    		// proceed to storing data to db
    		Psychologist::create($this->data($data) + ['resume' => $resume]);
    		
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
    protected function validateFile()
    {
    	// file extension should only be jpeg, png, jpg, bmp
    	// file size should only be 1024 megabytes

    	return $this->validate([

    		'resume' => ['required', 'mimes:jpeg,bmp,png,jpg', 'size:1024']

    	]);
    }

    protected function create(array $data)
    {
    	return Psychologist::create($this->data($data));
    }

    protected function data(array $data)
    {
    	return [

    		'first_name' => $data['firstname'],
    		'middlename' => $data['middle_name'],
    		'lastname' => $data['middle_name'],
    		'email' => $data['email'],
    		'birthdate' => $data['birthdate'],
    		'contact_number' => $data['contact_number'],
    		'address' => $data['address']
    	];
    }
}
