<div class="container">

	@php
		$employees = $client->users()->whereHas('roles', function($query){ $query->where('name', 'member'); });
	@endphp
	<div class="row justify-content-center mb-3">
		<div class="col-md-8 text-center">
			<div>
				<span>Total Employees</span>
			</div>
			<div>
				<h1>{{ $employees->count() }}</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="d-flex align-content-end mb-3">
			<div>
				<a href="{{ isset($client) ? route('client.user.create', $client->id) : route('users.create') }}" 
					class="btn btn-primary btn-sm"
					>
					<i class="fa fa-plus"></i>
					<span>Create User</span>
				</a>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-stripe">
				<thead>
					<tr>
						<th>Avatar</th>
						<th>Name</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($employees->with(['roles'])->get() as $user)
						<tr>
							<td>
								<img src="{{ asset('sb-admin/img/undraw_profile.svg') }}" alt="{{ $user->name }}" height="30" width="30"class="text-center">
							</td>
							<td>{{ $user->name }}</td>
							<td>
								<span class="{{ $user->is_active ? 'badge badge-success' : 'badge badge-danger' }}">
									{{ $user->is_active ? 'Active' : 'Inactive' }}
								</span>
							</td>
							<td align="right">
								<a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">
									<i class="fa fa-edit"></i>
								</a> |
								<a href="#" class="btn btn-{{ $user->is_active ? 'secondary' : 'primary' }} btn-sm"
									data-toggle="modal" data-target="#update-status-{{ $user->id}}">
									<i class="fa fa-eye"></i>
								</a>

								@include('pages.superadmin.clients.users.modals.update-status')
							</td>
						</tr>
					@endforeach 
				</tbody>
			</table>
		</div>
	</div>
</div>