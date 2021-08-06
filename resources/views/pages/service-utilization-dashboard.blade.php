@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row mb-3">
			<div class="col-md-12">
				<h4>Service Utilization Dashboard</h4>
				<hr>

			</div>
			<div class="col-md-12 mb-3">
				<a href="{{ route('home') }}" class="btn btn-info">
					<i class="fa fa-arrow-left"></i>
					<span>Return Back</span>
				</a>
			</div>
			
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