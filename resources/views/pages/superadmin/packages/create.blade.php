@extends('layouts.app')


@section('content')
	

	<div class="container-fluid">
		<div class="row offset-md-3">
			<div class="col-md-8">
				@include('alerts.message')
				<div class="card mb-3 mt-3">
					<div class="card-body">
						<form action="{{ route('packages.store') }}" method="POST">
							@csrf
							<div class="form-group">
								<label>Package Name</label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea type="text" name="description" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="number" name="price" class="form-control">
							</div>
							<div class="form-group">
								<label>Number Of Months Valid</label>
								<input type="number" name="no_of_months" class="form-control">
							</div>

							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="{{ route('packages.index') }}" class="btn btn-secondary">Cancel</a>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection