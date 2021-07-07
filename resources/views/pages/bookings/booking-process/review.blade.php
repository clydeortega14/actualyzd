@extends('layouts.app')


@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-body">
						<p class="lead text-center mt-5">
							Review Booking Details
						</p>

						<ul class="list-group">
						  	<li class="list-group-item d-flex justify-content-between align-items-center">
						    	On Boarding Questions
						    	<a href="#">link to on boarding questions</a>
						  	</li>
						  	<li class="list-group-item d-flex justify-content-between align-items-center">
						    	Date and Time
						    	<a href="#">Friday July 9, 2021 @ 9:00 am - 10:00 am</a>
						  	</li>
						  	<li class="list-group-item d-flex justify-content-between align-items-center">
						    	Psychologist
						    	<a href="#">Juan Dela Cruz</a>
						  	</li>
						</ul>


						<div class="row mt-3">
							<div class="col-md-6">
								<button class="btn btn-primary btn-block">Confirm</button>
								
							</div>

							<div class="col-md-6">
								<a href="#" class="btn btn-secondary btn-block">Cancel</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop