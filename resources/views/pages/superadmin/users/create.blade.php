@extends('layouts.app')


@section('content')

	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">{{ isset($user) ? 'Edit '.$user->name : 'Create User' }} @if(isset($client)) For {{ $client->name }} @endif</h1>


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
							
							@include('alerts.message')

							<div class="row justify-content-between">
								<div class="col-sm-5">

									<!-- if current user is superadmin -->
									@if(auth()->user()->hasRole('superadmin'))

										<!-- check if there is $client variable has provided -->
										@if(isset($client))

											<!-- make a hidden input with the value of client id -->
											<input type="hidden" name="client_id" value="{{ $client->id }}">
										@else

											<!-- list of clients / company as options for tagging user to client -->
											<div class="form-group">
												<label>Client / Company <small class="text-danger">( required only for client users )</small></label>
												<select type="combobox" name="client_id" class="form-control">
													<option disabled selected> - Choose Client / Company - </option>
													@foreach($clients as $client)
														<option value="{{ $client->id }}" {{ $isUser && $user->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
													@endforeach
												</select>
											</div>

										@endif

									<!-- if current user has the role of admin -->
									@elseif(auth()->user()->hasRole('admin'))

										<!-- make a hidden input with the value of current user client_id -->
										<input type="hidden" name="client_id" value="{{ auth()->user()->client_id }}">

									@endif
									
									<div class="form-group">
										<label>Name <small class="text-danger">*</small></label>
										<input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $isUser ? $user->name : old('name') }}" required {{ $isUser ? 'readonly' : '' }} >
									</div>

									<div class="form-group">
										<label>Email<small class="text-danger">*</small></label>
										<input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ $isUser ? $user->email : old('email') }}" required {{ $isUser ? 'readonly' : ''}}>
									</div>

									<div class="form-group">
										<label>Username<small class="text-danger">*</small></label>
										<input type="text" name="username" class="form-control" placeholder="Enter username" value="{{ $isUser? $user->username : old('username') }}" required {{ $isUser ? 'readonly' : ''}}>
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
									@endif

									<div class="form-group">
										<button type="submit" class="btn btn-primary">Submit</button>
										<a href="{{ url('users') }}" class="btn btn-danger">Cancel</a>
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
														@else
															<input type="checkbox" name="roles[]" value="{{ $role->id }}">
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