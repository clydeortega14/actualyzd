@extends('layouts.sb-admin.master')


@section('content')

	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Create User</h1>


		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('client/users') }}" method="PUT">
							@csrf
							
							<div class="row justify-content-between">
								<div class="col-sm-5">
									
									<div class="form-group">
										<label>Name <small class="text-danger">*</small></label>
										<input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $user->name }}" required>
									</div>

									<div class="form-group">
										<label>Email<small class="text-danger">*</small></label>
										<input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ $user->email }}" required>
									</div>

									<div class="form-group">
										<label>Username<small class="text-danger">*</small></label>
										<input type="text" name="username" class="form-control" placeholder="UserName" value="{{ $user->username }}" required>
									</div>

                                    <hr>

									<div class="form-group">
										<label>Password<small class="text-danger">*</small></label>
                                        <input type="checkbox" name="user_status" class="cm-toggle blue" id="update-password"> 
										<input type="password" name="password" class="form-control" value="" placeholder="********" required readonly>
									</div>

									<div class="form-group">
										<label>Confirm Password<small class="text-danger">*</small></label>
										<input type="password" name="password_confirmation" class="form-control" placeholder="********" required readonly>
									</div>

									<div class="form-group d-flex justify-content-end">
										<a href="{{ url('client/users') }}" class="btn btn-danger mr-2">Cancel</a>
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>


									
								</div>

								<div class="col-sm-7">
									
									<h3>Roles</h3>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th></th>
													<th>Role</th>
													<th>Permissions</th>
												</tr>
											</thead>

											<tbody>
												@foreach($roles as $role)
												<tr>
													<td>
														<input type="radio" name="roles[]" value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked': '' }} >
													</td>
													<td>{{ $role->display_name }}</td>
													<td>
														@if(count($role->permissions) > 0)
															@foreach($role->permissions as $permission)
																<span class="{{ $permission->class }}">{{ $permission->name }}</span>
															@endforeach
														@else
														<span class="badge badge-danger">no permissions available</span>
														@endif
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>
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

@section('js_scripts')

    <script>
        $(function() {
            $('#update-password').on('change', function() {
                
                if($(this).is(':checked')) {
                    return $('[type="password"]').attr('readonly', false);
                }

                return $('[type="password"]').attr('readonly', true);
            });
        });
    </script>
@stop