@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-4">
					<div class="card-body">
						<div class="align-content-center text-center">
							<h5 class="card-title">Please select client and it's participants</h5>
						</div>
					</div>
				</div>
                
                <div class="card mb-4">
                	<div class="card-body">
                		<form action="{{ route('booking.store.client.participants') }}" method="GET">
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