@extends('layouts.app')


@section('content')


	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-gray-500 text-center mb-3">Main Menu</h2>
				<hr>
			</div>
			<div class="col-md-4">
				<a href="{{ route('service.utilization.dashboard') }}">
				<div class="card mb-3">
					<div class="card-body text-center">
						<h5 class="card-title mb-3">Service Utilization Dashboard</h5>

						<div class="d-flex align-items-center justify-content-center">
							<span style="font-size: 3.5em;">
								<i class="fa fa-chart-bar"></i>
							</span>
						</div>
					</div>
				</div>
				</a>
			</div>
			<div class="col-md-4">
				<a href="{{ route('users.index') }}">
				<div class="card mb-3">
					<div class="card-body text-center">
						<h5 class="card-title mb-3">Users</h5>

						<div class="d-flex align-items-center justify-content-center">
							<span style="font-size: 3.5em;">
								<i class="fa fa-users"></i>
							</span>
						</div>
					</div>
				</div>
				</a>
			</div>
			@if(auth()->user()->hasRole('superadmin'))
				<div class="col-md-4">
					<a href="{{ route('bookings.index') }}">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Bookings</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-book"></i>
								</span>
							</div>
						</div>
					</div>
					</a>
				</div>
				<div class="col-md-4">
					<a href="{{ route('clients.index') }}">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Clients</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-address-card"></i>
								</span>
							</div>
						</div>
					</div>
					</a>
				</div>

				<div class="col-md-4">
					<a href="{{ route('setups.home') }}">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Set ups</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-cogs"></i>
								</span>
							</div>
						</div>
					</div>
					</a>
				</div>
				<div class="col-md-4">
					<a href="{{ route('progress.report') }}">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Progress Reports</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-list-alt"></i>
								</span>
							</div>
						</div>
					</div>
					</a>
				</div>
			@elseif(auth()->user()->hasRole('admin'))
				<div class="col-md-4">
					<a href="{{ url('company_info') }}">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Company</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-building"></i>
								</span>
							</div>
						</div>
					</div>
					</a>
				</div>
			@endif
		</div>
	</div>
@endsection