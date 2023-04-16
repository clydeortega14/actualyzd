@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row justify-content-between mb-3">
			<div class="col-md-8">
				<h3>Service Utilization Dashboard</h3>
			</div>
			@if(auth()->user()->hasRole('superadmin'))
				<div class="col-md-4" align="right">
					<a href="{{ route('bookings.index') }}" class="btn btn-primary">
						<i class="fa fa-calendar"></i>
						<span>Book a session</span>
					</a>
				</div>
			@endif
		</div>

		<div class="row mb-3">
			@if(auth()->user()->hasRole('superadmin'))

				<div class="col-md-3">
					<div class="card mb-3">
						<div class="card-header">
							Client Lists
						</div>

						<div class="card-body">
							<!-- Client List Component -->
							<client-lists></client-lists>
						</div>
					</div>
					

				</div>
			@endif

			<div class="{{ auth()->user()->hasRole('admin') ? 'col-md-12' : 'col-md-9' }}">
				<service-utilization></service-utilization>
			</div>
		</div>

		

		
	</div>
@endsection