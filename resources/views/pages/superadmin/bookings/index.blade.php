@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-gray-500 mb-3">Bookings</h1>
				<a href="{{ route('home') }}" class="btn btn-outline-secondary mb-3">
		            <i class="fa fa-arrow-left"></i>
		            <span>Return Back</span>
	            </a>
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