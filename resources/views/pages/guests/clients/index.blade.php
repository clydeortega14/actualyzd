@extends('guest-layouts.master')


@section('title', 'Client App Form')


@section('content')
	
	<div class="login-box">
		<div class="logo">
            <a href="javascript:void(0);">Client Application Form </a>
            <small></small>
        </div>

        <div class="card">
        	<div class="body">
        		<div class="msg">Please Fill out this form</div>

        		<div class="form-group">
        			<div class="form-line">
        				<input type="text" name="company_name" class="form-control" placeholder="Company Name">
        			</div>
        		</div>

        		<div class="form-group">
        			<div class="form-line">
        				<input type="number" name="number_of_employees" class="form-control" placeholder="Number of employees">
        			</div>
        		</div>

        		<div class="form-group">
        			<div class="form-line">
        				<input type="text" name="contact_number" class="form-control" placeholder="Contact Number">
        			</div>
        		</div>

        		<div class="form-group">
        			<div class="form-line">
        				<textarea class="form-control no-resize" rows="4" name="postal_address" placeholder="Postal Address"></textarea>
        			</div>
        		</div>

        		<div class="row">
        			<div class="col-xs-6 pull-right">
        				<a href="#" class="btn btn-danger">Cancel</a>
        				<button class="btn btn-primary">Submit</button>
        			</div>
        		</div>

        	</div>
        </div>
	</div>

@endsection