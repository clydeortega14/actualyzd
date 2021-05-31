@extends('layouts.sb-admin.master')


@section('content')
	
	<div class="container-fluid">
		<h4>Packages </h4>
		<div class="row">
			<div class="col-md-12">
				@include('alerts.message')
				<div class="card mb-3">
					<div class="card-header">
						<div class="d-flex justify-content-end">
							<a href="{{ route('packages.create') }}" class="btn btn-info btn-sm">Add Package</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>Price per month</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($packages as $package)
										<tr>
											<td>
												<a href="#">
													{{ $package->name }}
												</a>
											</td>
											<td>{{ $package->price }} for {{ $package->no_of_months }} months</td>
											<td>
												<a href="{{ route('packages.edit', $package->id) }}">
													Edit
												</a> |
												<a href="{{ route('package.services', $package->id) }}">
													Services
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

@stop