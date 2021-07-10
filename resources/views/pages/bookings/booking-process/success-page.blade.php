@extends('layouts.app')


@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-body">
						<div class="align-items-center text-center">
							<h3 class="card-title text-center mt-5">
								You have successfully booked a session!
							</h3>

							<ul class="list-group mt-5">
							  	<li class="list-group-item d-flex justify-content-between align-items-center">
							    	Firstimer
							    	<span>Yes</span>
							  	</li>
							  	<li class="list-group-item d-flex justify-content-between align-items-center">
							    	Intent to self harm
							    	<span>Yes</span>
							  	</li>
							  	<li class="list-group-item d-flex justify-content-between align-items-center">
							    	Date and Time
							    	<span>Friday July 9, 2021 @ 9:00 am - 10:00 am</span>
							  	</li>
							  	<li class="list-group-item d-flex justify-content-between align-items-center">
							    	Psychologist
							    	<span>Juan Dela Cruz</span>
							  	</li>
							</ul>
							<a href="{{ route('home') }}" class="btn btn-primary btn-block mt-5">Return Home</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop