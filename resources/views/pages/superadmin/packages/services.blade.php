@extends('layouts.sb-admin.master')

@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('alerts.message')
			</div>

			<div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header">Add {{ $package->name }} Service</div>
					<div class="card-body">
						<form action="{{ route('package.service') }}" method="POST">
							@csrf

							<input type="hidden" name="package_id" value="{{ $package->id}}">

							<div class="form-group">
								<label>Session Type</label>
								<select name="session_type_id" class="form-control">
									<option>- select session -</option>
									@foreach($session_types as $type)
										<option value="{{ $type->id }} ">{{ $type->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label>Limit</label>
								<input type="number" name="limit" class="form-control">
							</div>

							<button type="submit" class="btn btn-info">Submit</button>
							<a href="{{ route('packages.index') }}" class="btn btn-danger">Cancel</a>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-header">{{ $package->name }} Services </div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Limit</th>
										<th>Session Type</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									@foreach($package->services as $service)
										<tr>
											<td>{{ $service->limit }}</td>
											<td>{{ $service->sessionType->name }}</td>
											<td>
												<a href="#">
													<i class="fa fa-edit"></i>
												</a> |
												<a href="#">
													<i class="fa fa-trash"></i>
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection