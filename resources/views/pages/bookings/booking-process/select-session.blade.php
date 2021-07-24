@extends('layouts.app')

@section('content')
	
	<div class="container" style="margin-top: 1.5em;">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mb-4">
					<div class="card-body">
						<div class="align-content-center text-center">
							<h5 class="card-title">Please select type of session</h5>
						</div>
					</div>
				</div>
				<div class="card mb-4">
					<div class="card-body">
						<form action="{{ route('booking.store.session.type') }}" method="GET">
							@foreach($session_types as $type)
								
								<input  type="submit" name="session_type_id" value="{{ $type->id }}">
								<button name="session_name" value="{{ $type->name }}" class="btn btn-outline-primary btn-lg btn-block mb-3">
									{{ $type->name }}
								</button>
							@endforeach
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>

@stop