@extends('layouts.app')

@section('content')

	<div class="container-fluid">

		
		<div class="row mb-3">
			<div class="col-md-12">
				<h3>Book a session</h3>	
				{{ Breadcrumbs::render('booking.onboarding') }}
			</div>
		</div>
		<div class="row mb-3">
			{{-- <div class="col-md-3">
				
				<div class="row">
					<div class="col-md-12">
						<div class="card text-white bg-primary mb-3">
						  	<div class="card-body">
						    	<h5 class="card-title text-center p-3">Onboarding Questions</h5>
						    	<p class="card-text">By answering the onboarding questions, it helps the psychologist to determine what is your main concern.</p>
						  	</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card mb-3">
						  	<div class="card-body">
						    	<h5 class="card-title text-center p-3">Complete the booking by selecting date, time and psychologist</h5>
						  	</div>
						</div>
					</div>
				</div>


			</div> --}}

			<div class="col-md-12">
				

				{{-- <div class="card text-white bg-primary mb-3">
					<div class="card-body text-center">
						<h4 class="card-title">Onboarding Questions</h4>
						<p class="card-text">By answering the onboarding questions, it helps the psychologist to determine what is your main concern</p>
					</div>
				</div> --}}
				<div class="card mb-3">
					{{-- <div class="card-header">Onboarding Questions</div> --}}
					<div class="card-body">
						<form action="{{ route('booking.store.onboarding.question') }}" method="POST">

							@csrf

							{{-- <p class="text-center text-danger">NOTE: Please fill all the fields</p> --}}

							<ul class="list-unstyled">

								{{-- First Timer / Repeater --}}
								<ul class="list-unstyled ml-4 mt-4">

									{{-- First Timer / Repeater --}}
									<li class="mb-3">
										
										<h3 class="text-primary">Are you a first timer or a repeater to this session?</h3>
										
										<div class="ml-5">
											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="is_firsttimer" value="1" id="firstimer" :checked="{{ session()->has('assessment.is_firsttimer') && session()->has('assessment.is_firsttimer') == 1 ? '1' : '0' }}">
												<label class="custom-control-label" for="firstimer">First Timer</label>
											</div>

											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="is_firsttimer" value="0" id="repeater" :checked="{{ session()->has('assessment.is_firsttimer') && session('assessment.is_firsttimer') == 0 ? '1' : '0' }}">
												<label class="custom-control-label" for="repeater">Repeater</label>
											</div>
										</div>
									</li>

									{{-- Self Harm  --}}
									<li class="mb-3">
										<h3 class="text-primary">I have plans to harm myself?</h3>
										<div class="ml-5">
											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="self_harm" value="1" id="1" :checked="{{ session()->has('assessment.self_harm') && session('assessment.self_harm') == 1 ? '1' : '0' }}">
												<label class="custom-control-label" for="1">Yes</label>
											</div>
										

											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="self_harm" value="0" id="0" :checked="{{ session()->has('assessment.self_harm') && session('assessment.self_harm') == 0 ? '1' : '0' }}">
												<label class="custom-control-label" for="0">No</label>
											</div>
										</div>
									</li>

									{{-- Harm Other People --}}
									<li class="mb-3">
										
										<h3 class="text-primary">I have plans to harm other people?</h3>
										
										<div class="ml-5">
											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="harm_other_people" value="1" id="yes-harm-other-people" :checked="{{ session()->has('assessment.harm_other_people') && session('assessment.harm_other_people') == 1 ? '1' : '0' }}">
												<label class="custom-control-label" for="yes-harm-other-people">Yes</label>
											</div>
										

											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="harm_other_people" value="0" id="no-harm-other-people" :checked="{{ session()->has('assessment.harm_other_people') && session('assessment.harm_other_people') == 0 ? '1' : '0' }}" >
												<label class="custom-control-label" for="no-harm-other-people">No</label>
											</div>
										</div>
									</li>
								</ul>
							

	                        <ul class="list-unstyled ml-4">
	                        	@foreach($categories as $category)
		                        	<li class="mb-3">
		                        		<h3 class="text-primary">{{ $category->name }}</h3>
		                        		@include('pages.bookings.components.questionnaire')
		                        	</li>
	                        	@endforeach
	                        </ul>

	                        <div class="form-group">
	                        	<button type="submit" class="btn btn-primary btn-block">Proceed Next</button>
	                        	<a href="#" class="btn btn-danger btn-block">Cancel</a>
	                        </div>
	                    </form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop