@extends('layouts.app')


@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4>Packages </h4>
				<hr>
			</div>
			<div class="col-md-12">
				<a href="{{ route('home') }}" class="btn btn-info mb-3 mr-2">
					<i class="fa fa-home"></i>
					<span>Home</span>
				</a>
				<a href="{{ route('setups.home') }}" class="btn btn-outline-info mb-3 mr-2">
					<i class="fa fa-cogs"></i>
					<span>Set ups</span>
				</a>
			</div>
			<div class="col-md-12">
				@include('alerts.message')
				<div class="card mb-3">
					<div class="card-header">
						<div class="d-flex justify-content-end">
							<a href="{{ route('packages.create') }}" class="btn btn-primary btn-sm">
								<i class="fa fa-plus-circle"></i>
								<span>Add Package</span>
							</a>
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
											<td> &#8369; {{ $package->formattedPrice() }} - {{ $package->no_of_months }} {{ $package->no_of_months <= 1 ? 'Month' : 'Months' }}</td>
											<td>
												<a href="{{ route('packages.edit', $package->id) }}" class="btn btn-primary btn-sm">
													<i class="fa fa-edit"></i>
												</a> |
												<a href="{{ route('package.services', $package->id) }}" class="btn btn-info btn-sm">
													<i class="fa fa-hand-holding"></i>
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