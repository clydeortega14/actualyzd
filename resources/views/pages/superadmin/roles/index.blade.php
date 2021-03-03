@extends('layouts.sb-admin.master')

@section('content')
	
	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Roles</h1>

		<div class="row">
			<div class="col-sm-12">
				<div class="card shadow mb-4">
					<div class="card-header py-4">
						<a href="{{ route('roles.create') }}" class="btn btn-info">Create Role</a>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Description</th>
										<th>Permission</th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									@foreach($roles as $role)
										<tr>
											<td>{{ $role->display_name }}</td>
											<td>Description</td>
											<td>
												@if(count($role->permissions) > 0)
													@foreach($role->permissions as $permission)
														<span class="{{ $permission->class }}">{{ $permission->name }}</span>
													@endforeach
												@else
													<span class="badge badge-danger">not available</span>
												@endif
											</td>
											<td>
												<a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info btn-sm">
													<i class="fa fa-edit"></i>
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