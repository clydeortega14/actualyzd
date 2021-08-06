@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-gray-500 text-center mb-3">Bookings</h2>
				<hr>
				<div class="d-flex justify-content-between">
					<a href="{{ route('home') }}" class="btn btn-info mb-3">
			            <i class="fa fa-arrow-left"></i>
			            <span>Return Back</span>
		            </a>
		            <a href="{{ route('booking.onboarding') }}" class="btn btn-primary mb-3">
			            <i class="fa fa-book"></i>
			            <span>Book a session</span>
		            </a>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<bookings-lists></bookings-lists>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection