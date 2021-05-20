@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<form>
			<div class="row">
				<div class="col-md-6">
					<div class="card mb-3">
						<div class="card-header">Create User</div>
						<div class="card-body">

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

							<div class="form-group">
								<a href="{{ url('client/users') }}" class="btn btn-danger mr-2">Cancel</a>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card mb-3">
						<div class="card-header">Roles</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th></th>
											<th>Role Name</th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										@foreach($roles as $role)
											<tr>
												<td><input type="checkbox" name="roles[]" value="{{ $role->id}}"></td>
												<td>{{ $role->name }}</td>
												<td>
													@if(count($role->permissions) > 0)
														@foreach($role->permissions as $permission)
															<span class="badge badge-primary">{{ $permission->name }}</span>
														@endforeach
													@else

														<span>NOT AVAILABLE</span>
													@endif
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

@stop