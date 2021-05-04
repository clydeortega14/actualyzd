@extends('layouts.sb-admin.master')


@section('content')

	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Users</h1>

		<div class="row">
			<div class="col-sm-12">
				<div class="card shadow mb-4">
					<div class="card-header py-2">
						<select name="" id="select-client">
							<option value="0" selected>All</option>
							@foreach($clients as $client)
								<option value="{{ $client->id }}">{{ $client->name }}</option>
							@endforeach
						</select>
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
										<tr data-client-id="{{ $user->client_id }}" class="user">
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

@section('js_scripts')
	<script>
	$(function() {

		$('#select-client').on('change', function() {
			let client = $('#select-client').val();
			let user = $('.user');
			if(client == 0) return user.show();
			
			user.hide();
			if(user.attr(`[data-client-id="${client}"]`) === undefined) {
				$('.user').attr(`[data-client-id="${client}"]`).show();
			}
		});

	});
	
	</script>
@stop