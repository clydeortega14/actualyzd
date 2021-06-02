@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="card mb-3">
					<div class="card-body">
						<img src="{{ asset('images/user.png') }}" alt="{{ $user->name }}" class="img-fluid rounded mx-auto d-block" height="230" width="230">
						<div class="text-center mt-3">
							<h5>{{ $user->name }} <br>
								<small>{{ $user->email }}</small>
							</h5>

							<a href="#" class="btn btn-primary">
								<i class="fa fa-upload"></i>
								<span>Upload Avatar</span>
							</a>

						</div>
					</div>
				</div>
			</div>

			<div class="col-md-9">
				<div class="card mb-3">
					<div class="card-body">
						<div class="d-sm-flex justify-content-end">
							<div>
								<a href="#" class="btn btn-primary btn-sm">Book Session</a>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

@stop