@extends('layouts.sb-admin.master')


@section('content')

	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Create User</h1>


		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<div class="row justify-content-center">
							<div class="col-sm-5">
								
									<div class="form-group">
										<label>Name <small class="text-danger">*</small></label>
										<input type="text" name="name" class="form-control" placeholder="Enter Name" required>
									</div>

									<div class="form-group">
										<label>Email<small class="text-danger">*</small></label>
										<input type="email" name="email" class="form-control" placeholder="email@example.com" required>
									</div>


									<div class="form-group">
										<label>Password<small class="text-danger">*</small></label>
										<input type="password" name="password" class="form-control" placeholder="********" required>
									</div>

									<div class="form-group">
										<label>Confirm Password<small class="text-danger">*</small></label>
										<input type="password" name="password_confirmation" class="form-control" placeholder="********" required>
									</div>

									<div class="form-group d-flex justify-content-end">
										<a href="{{ route('users.index') }}" class="btn btn-danger mr-2">Cancel</a>
										<button class="btn btn-primary">Submit</button>
									</div>
								
							</div>
							<div class="col-sm-5">
								
								<h3>Roles</h3>
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th></th>
												<th>Role</th>
											</tr>
										</thead>

										<tbody>
											<tr>
												<td><input type="checkbox" name="roles[]"></td>
												<td>Client Admin</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

@stop