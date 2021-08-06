@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-body">
						<div clas="d-flex align-items-center">
						<h1 class="card-title text-center align-items-center">
							Main Menu
						</h1>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<a href="{{ route('psychologist.schedules.page') }}">
				    <div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Schedules</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-calendar-check"></i>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-4">
				<a href="{{ route('psychologist.bookings') }}">
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
				<a href="{{ route('progress.report') }}">
				    <div class="card mb-3">
						<div class="card-body text-center">
							<h5 class="card-title mb-3">Progress Reports</h5>

							<div class="d-flex align-items-center justify-content-center">
								<span style="font-size: 3.5em;">
									<i class="fa fa-clipboard-list"></i>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>

@endsection