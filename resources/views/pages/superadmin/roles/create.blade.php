@extends('layouts.app')


@section('content')

	<div class="container-fluid">


		<div class="row">
			<div class="col-md-12">
				<h4>Create Role</h4>
				<hr>
				<a href="{{ route('home') }}" class="btn btn-info mr-2 mb-3">
					<i class="fa fa-home"></i>
					<span>Home</span>
				</a>
				<a href="{{ route('setups.home') }}" class="btn btn-outline-info mr-2 mb-3">
					<i class="fa fa-cogs"></i>
					<span>Set ups</span>
				</a>
				<a href="{{ route('access.rights') }}" class="btn btn-outline-info mr-2 mb-3">
					<i class="fa fa-wrench"></i>
					<span>Access Rights</span>
				</a>
				<a href="{{ route('roles.index') }}" class="btn btn-outline-info mr-2 mb-3">
					<i class="fa fa-clipboard-check"></i>
					<span>Roles</span>
				</a>
			</div>
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						@php
							$hasRole = isset($role) ? true : false;
						@endphp
						<form action="{{ $hasRole ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
							@csrf

							@if($hasRole)
								@method('PUT')
							@endif
						<div class="row justify-content-between">
							<div class="col-sm-5">
								
								<div class="form-group">
									<label>Name <small class="text-danger">(required)</small></label>
									<input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $hasRole ? $role->name : old('name') }}" required {{  $hasRole ? 'disabled' : ''}}>
								</div>

								<div class="form-group">
									<label>Display Name <small>(Optional)</small></label>
									<input type="text" name="display_name" class="form-control" placeholder="Enter Display Name" value="{{ $hasRole ? $role->display_name : old('display_name') }}" required>
								</div>


								<div class="form-group">
									<label>Description <small>(Optional)</small></label>
									<textarea class="form-control" rows="4" cols="10" name="description" placeholder="Enter Description">{{ $hasRole ? $role->description : old('description') }}</textarea>
								</div>

								<div class="form-group d-flex justify-content-end">
									<a href="{{ route('roles.index') }}" class="btn btn-danger mr-2">Cancel</a>
									<button class="btn btn-primary">Submit</button>
								</div>
								
							</div>
							<div class="col-sm-5">
								
								<h3>Permissions</h3>
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th></th>
												<th>permission</th>
											</tr>
										</thead>

										<tbody>
											@foreach($permissions as $permission)
												<tr>
													<td>
														@if($hasRole)
															@php
																$checked = '';
															@endphp

															@if(count($role->permissions) > 0)
																@foreach($role->permissions as $role_permission)
																	@if($role_permission->id == $permission->id)
																		@php
																			$checked = 'checked';
																		@endphp
																	@endif
																@endforeach
																<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{$checked}}>
															@else
																<input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
															@endif
														@else

															<input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
														@endif
														
													</td>
													<td>
														<span class="{{ $permission->class }}">{{ $permission->name }}</span>
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