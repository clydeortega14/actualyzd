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
						<div class="form-group row">
							<label class="col-form-label col-sm-4 text-md-right">Reason:</label>
							<div class="col-sm-6">
								<textarea class="form-control" placeholder="Please specify your reason here" rows="5" cols="50"></textarea>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-6 offset-md-4">
								<button class="btn btn-primary">Submit</button>
								<a href="{{ route('member.home') }}" class="btn btn-danger">Cancel</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection