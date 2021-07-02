@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header">Onboarding Questions</div>
					<div class="card-body">
						<div class="form-group mb-4 ml-4">
							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" name="is_firsttimer" value="1" id="firstimer">
								<label class="form-check-label" for="firstimer">First Timer</label>
							</div>

							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" name="is_firsttimer" value="0" id="repeater">
								<label class="form-check-label" for="repeater">Repeater</label>
							</div>
						</div>
                        <ol style="list-style-type: upper-roman;">
                        	@foreach($categories as $category)
	                        	<li>
	                        		<b>{{ $category->name }}</b>
	                        		@include('pages.bookings.components.questionnaire')
	                        	</li>
                        	@endforeach
                        </ol>

                        <div class="form-group">
                        	{{-- <button type="submit" class="btn btn-primary btn-block">Submit</button> --}}
                        	<a href="{{ route('booking.date.and.time') }}" class="btn btn-primary btn-block">Submit</a>
                        	<a href="#" class="btn btn-secondary btn-block">Cancel</a>
                        </div>

					</div>
				</div>
			</div>
		</div>
	</div>

@stop