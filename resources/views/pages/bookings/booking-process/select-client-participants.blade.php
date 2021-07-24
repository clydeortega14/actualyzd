@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-4">
					<div class="card-body">
						<div class="align-content-center text-center">
							<h5 class="card-title">Please select type of session, client and it's participants</h5>
						</div>
					</div>
				</div>
                
                <div class="card mb-4">
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