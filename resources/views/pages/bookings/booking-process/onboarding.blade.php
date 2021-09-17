@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header">Onboarding Questions</div>
					<div class="card-body m-3">
						<form action="{{ route('booking.store.onboarding.question') }}" method="POST">

							@csrf

							<p class="text-center text-danger">NOTE: Please fill all the fields</p>

							<ul>
								{{-- First Timer / Repeater --}}
								<ul>
									{{-- First Timer / Repeater --}}
									<li>
										
										<p class="lead">Are you a first timer or a repeater to this session?</p>
										
										<div class="ml-5">
											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="is_firsttimer" value="1" id="firstimer">
												<label class="custom-control-label" for="firstimer">First Timer</label>
											</div>

											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="is_firsttimer" value="0" id="repeater">
												<label class="custom-control-label" for="repeater">Repeater</label>
											</div>
										</div>
									</li>

									{{-- Self Harm  --}}
									<li>
										
										<p class="lead">I have plans to harm myself?</p>
										
										<div class="ml-5">
											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="self_harm" value="1" id="1">
												<label class="custom-control-label" for="1">Yes</label>
											</div>
										

											<div class="custom-control custom-radio mb-2">
												<input type="radio" class="custom-control-input" name="self_harm" value="0" id="0">
												<label class="custom-control-label" for="0">No</label>
											</div>
										</div>
											
										
										
									</li>
								</ul>
							

	                        <ul>
	                        	@foreach($categories as $category)
		                        	<li>
		                        		<p class="lead">{{ $category->name }}<p>
		                        		@include('pages.bookings.components.questionnaire')
		                        	</li>
	                        	@endforeach
	                        </ul>

	                        <div class="form-group">
	                        	<button type="submit" class="btn btn-primary btn-block">Submit</button>
	                        	<a href="#" class="btn btn-secondary btn-block">Cancel</a>
	                        </div>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop