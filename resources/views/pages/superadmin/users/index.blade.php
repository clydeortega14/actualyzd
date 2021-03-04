@extends('layouts.sb-admin.master')


@section('content')

	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Users</h1>

		<div class="row">
			<div class="col-sm-12">
				<div class="card shadow mb-4">
					<div class="card-header py-4">
						<a href="{{ route('users.create') }}" class="btn btn-info btn-sm float-right">
							<i class="fa fa-plus"></i>
							<span>Create User</span>
						</a>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th></th>
										<th>Name</th>
										<th>Email</th>
										<th>Status</th>
										<th>Role</th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									@foreach($users as $user)
										@php
											$active = $user->is_active;
										@endphp
										<tr>
											<td><img src="{{ asset('sb-admin/img/undraw_profile.svg') }}" alt="{{ $user->name }}" height="45" width="45"class="text-center"></td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>
												<span class="{{ $active ? 'badge badge-success' : 'badge badge-danger' }}">
													{{ $active ? 'Active' : 'Inactive' }}
												</span>
											</td>
											<td>
												@if(count($user->roles) > 0)
													@foreach($user->roles as $role)
														<span class="{{ $role->class }}">{{ $role->name }}</span>
													@endforeach
												@else
													<span class="badge badge-danger">Not Available</span>
												@endif
											</td>
											<td>
												<a href="{{ route('users.edit', $user->id) }}" >
													<i class="fa fa-edit"></i>
												</a> | 
												<a href="#">
													<i class="fa fa-trash"></i>
												</a>
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
	</div>

@stop