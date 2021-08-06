@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4 class="text-gray-300 text-center">Access Rights</h4>
				<hr>
				<a href="{{ route('home') }}" class="btn btn-info mr-2 mb-3">
					<i class="fa fa-home"></i>
					<span>Home</span>
				</a>
				<a href="{{ route('setups.home') }}" class="btn btn-outline-info mr-2 mb-3">
					<i class="fa fa-cogs"></i>
					<span>Set ups</span>
				</a>
			</div>
			<div class="col-md-6">
				<a href="{{ route('roles.index') }}">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Roles</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-clipboard-check"></i>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-6">
				<a href="{{ route('permissions.index') }}">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Permissions</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-eye"></i>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>

@endsection