@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3 class="text-gray-500 mb-3">Sessions</h3>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="d-flex justify-content-end">
							<a href="{{ route('booking.onboarding') }}" class="btn btn-primary mb-3">
					            <i class="fa fa-book"></i>
					            <span>Book a session</span>
				            </a>
			            </div>
					</div>
					<div class="card-body">
						<bookings-lists></bookings-lists>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection