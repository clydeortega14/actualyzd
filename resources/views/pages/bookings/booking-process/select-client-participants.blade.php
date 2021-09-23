@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">
		
		<h1>Book a session</h1>
		<a href="{{ route('home') }}" class="btn btn-outline-secondary mb-3">
			<i class="fa fa-arrow-left"></i>
			<span>Back to Home</span>
		</a>

		<div class="row">
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						<div class="card text-white bg-primary mb-3">
						  	<div class="card-body">
						    	<h4 class="card-title">Select session type, client and participants</h4>
						    	<p class="card-text">Select session type, client and participants of the session</p>
						  	</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="card mb-3">
						  	<div class="card-body">
						    	<h4 class="card-title">Choose date and time and psychologist</h4>
						    	<p class="card-text">select available date, time and psychologist.</p>
						  	</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card mb-3">
						  	<div class="card-body">
						    	<h4 class="card-title">Review</h4>
						    	<p class="card-text">Before the system will process your booking please review the session details.</p>
						  	</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card mb-3">
						  	<div class="card-body">
						    	<h4 class="card-title">Complete</h4>
						    	<p class="card-text">You have successfully booked a session.</p>
						  	</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				{{ Breadcrumbs::render('booking.select.client.participants') }}

				<div class="card text-white bg-primary mb-3">
				  	<div class="card-body text-center">
				    	<h4 class="card-title">Select session type, client and participants</h4>
				    	<p class="card-text">Select session type, client and participants of the session</p>
				  	</div>
				</div>

				<div class="card mb-3">
	                	<div class="card-body">
	                		<form action="{{ route('booking.store.client.participants') }}" method="GET">
	                			<div class="form-group row mt-4">
	                				<label class="col-form-label text-md-right col-sm-4">Type of session</label>
	                				<div class="col-sm-6">
	                					<select name="session_type" class="form-control">
	                					<option value="" disabled selected>Choose type of session</option>
	                					@foreach($session_types as $type)
	                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
	                					@endforeach
	                				</select>
	                				</div>
	                				
	                			</div>

	                			<client-participants :clients="{{ $clients }}"></client-participants>

				                <div class="form-group row">
					                <div class="col-sm-6 offset-md-4">
						                <button type="submit" class="btn btn-primary">Submit</button>
						                <a href="#" class="btn btn-secondary">Cancel</a>
					                </div>
				                </div>
			                </form>
	                	</div>
	                </div>


			</div>
		</div>
	</div>

@stop