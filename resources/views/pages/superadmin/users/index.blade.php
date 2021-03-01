@extends('layouts.sb-admin.master')


@section('content')

	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Users</h1>

		<div class="row">
			<div class="col-sm-12">
				<div class="card shadow mb-4">
					<div class="card-header py-4">
						<a href="{{ route('users.create') }}" class="btn btn-info">Create Schedule</a>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" width="100%" cellspacing="0">
								<thead>
									<tr>
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
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>
												<span class="{{ $active ? 'badge badge-success' : 'badge badge-danger' }}">
													{{ $active ? 'Active' : 'Inactive' }}
												</span>
											</td>
											<td>N/A</td>
											<td>
												<a href="#" class="btn btn-sm btn-primary">{{ $active ? 'Deactivate' : 'Activate' }}</a>
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