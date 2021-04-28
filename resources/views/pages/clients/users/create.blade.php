@extends('layouts.sb-admin.master')


@section('content')

	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Create User</h1>


		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('client/users') }}" method="POST">
							@csrf
							
							<div class="row justify-content-between">
								<div class="col-sm-5">
									
									<div class="form-group">
										<label>Name <small class="text-danger">*</small></label>
										<input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}" required>
									</div>

									<div class="form-group">
										<label>Email<small class="text-danger">*</small></label>
										<input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ old('email') }}" required>
									</div>

									<div class="form-group">
										<label>Username<small class="text-danger">*</small></label>
										<input type="text" name="username" class="form-control" placeholder="UserName" value="{{ old('username') }}" required>
									</div>

									<div class="form-group">
										<label>Password<small class="text-danger">*</small></label>
										<input type="password" name="password" class="form-control" value="" placeholder="********" required>
									</div>

									<div class="form-group">
										<label>Confirm Password<small class="text-danger">*</small></label>
										<input type="password" name="password_confirmation" class="form-control" placeholder="********" required>
									</div>

									<div class="form-group d-flex justify-content-end">
										<a href="{{ url('client/users') }}" class="btn btn-danger mr-2">Cancel</a>
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>


									
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop