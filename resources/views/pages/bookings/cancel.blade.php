@extends('layouts.sb-admin.master')


@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header">
						Reason for Cancel
					</div>

					<div class="card-body">
						<form action="{{ route('cancel.booking', $booking->id) }}" method="POST">
							@csrf
							<div class="form-group row">
								<label class="col-form-label col-sm-4 text-md-right">Reason:</label>
								<div class="col-sm-6">
									<textarea name="reason" class="form-control" placeholder="Please specify your reason here" rows="5" cols="50" required>{{ !is_null($booking->reschedule) ? $booking->reschedule->reason : '' }}</textarea>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-sm-6 offset-md-4">
									<button type="submit" class="btn btn-primary">Submit</button>
									<a href="{{ route('home') }}" class="btn btn-danger">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection