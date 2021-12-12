@extends('layouts.app')


@section('content')
	
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">

				<h3 class="mb-3">State your reason for canceling the session</h3>

				{{ Breadcrumbs::render('bookings.cancel', $booking) }}

				<div class="card mb-3">

					<div class="card-body">

						<form action="{{ route('cancel.booking', $booking->id) }}" method="POST">
							@csrf

							@foreach($reason_options as $option)
								<div class="custom-control custom-radio mb-3">
									<input type="radio" class="custom-control-input @error('reason') is-invalid @enderror " name="reason" value="{{ $option->id }}" id="{{ $option->id }}">
									<label class="custom-control-label" for="{{ $option->id }}">{{ $option->option_name }}</label>

									@error('reason')

										<div class="invalid-feedback">Must select atleast one options for your reason</div>
									@enderror

									@if($option->id === 5 || $option->option_name === 'Others')
										<textarea type="text" name="others_specify" class="form-control @error('others_specify') is-invalid @enderror" placeholder="Others specify..."></textarea>
										@error('others_specify')
											<div class="invalid-feedback">
												{{ $message }}	
											</div>
										@endif
									@endif
								</div>
							@endforeach

							<div class="form-group">
								<button class="btn btn-primary" type="submit">Confirm</button>
								<a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection