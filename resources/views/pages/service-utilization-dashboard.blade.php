@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row mb-3">
			<div class="col-md-12">
				<h3>Service Utilization Dashboard</h3>
				
			</div>
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