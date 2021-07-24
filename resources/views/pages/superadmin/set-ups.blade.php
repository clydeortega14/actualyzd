@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row justify-content-center">
		     <div class="col-md-12">
				<h2 class="text-gray-500 text-center mb-3">Set Ups</h2>
				<hr>
			</div>
			<div class="col-md-12 mb-3">
				<a href="{{ route('home') }}" class="btn btn-info">
					<i class="fa fa-home"></i>
					<span>Home</span>
				</a>
			</div>
			<div class="col-md-6">
				<a href="{{ route('packages.index') }}">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Packages</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-box-open"></i>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-6">
				<a href="{{ route('access.rights') }}">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Access Rights</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-wrench"></i>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-6">
				<a href="{{ route('assessments') }}">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Assessments</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-clipboard-list"></i>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-6">
				<a href="{{ route('time-lists.index') }}">
					<div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Time Lists</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-fw fa-clock"></i>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>

@endsection