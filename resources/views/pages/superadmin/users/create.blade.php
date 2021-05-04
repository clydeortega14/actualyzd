@extends('layouts.sb-admin.master')


@section('content')

	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Create User</h1>


		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						@php
							$isUser = isset($user) ? true : false;
						@endphp
						<form action="{{ $isUser ? route('users.update', $user->id) : route('users.store') }}" method="POST">
							@csrf
							@if($isUser)
								@method('PUT')
							@endif
							

							<div class="row justify-content-between">
								<div class="col-sm-5">
									
									<div class="form-group">
										<label>Name <small class="text-danger">*</small></label>
										<input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $isUser ? $user->name : old('name') }}" required {{ $isUser ? 'disabled' : '' }} >
									</div>

									<div class="form-group">
										<label>Email<small class="text-danger">*</small></label>
										<input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ $isUser ? $user->email : old('email') }}" required {{ $isUser ? 'disabled' : ''}}>
									</div>

									@if(!$isUser)
										<div class="form-group">
											<label>Password<small class="text-danger">*</small></label>
											<input type="password" name="password" class="form-control" value="" placeholder="********" required>
										</div>

										<div class="form-group">
											<label>Confirm Password<small class="text-danger">*</small></label>
											<input type="password" name="password_confirmation" class="form-control" placeholder="********" required>
										</div>
									@else
										<div class="form-group">
											<label for="status">Status</label>
											<select name="status" id="status" class="form-control">
												<option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>Active</option>
												<option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}>Inactive</option>
											</select>
										</div>
									@endif

									<div class="form-group d-flex justify-content-end">
										<a href="{{ url('users') }}" class="btn btn-danger mr-2">Cancel</a>
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
														<!-- for default checked  -->
														@if($isUser)
															@php
																$checked = '';
															@endphp
															@if(count($user->roles) > 0)
																@foreach($user->roles as $user_role)
																	@if($user_role->id == $role->id)
																		@php
																			$checked = 'checked';
																		@endphp
																	@endif
																@endforeach

																<input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $checked }}>
															@else
																<input type="checkbox" name="roles[]" value="{{ $role->id }}">
															@endif
														@endif
														<!-- end for default checked -->
														
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