@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12">
				<h4>Roles</h4>
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
			</div>
			<div class="col-sm-12">
				<div class="card shadow mb-4">
					<div class="card-header py-4">
						<a href="{{ route('roles.create') }}" class="btn btn-info btn-sm float-right">
							<i class="fa fa-plus"></i>
							<span>Create Role</span>
						</a>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover" width="100%" cellspacing="0">
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
											<td>{{ $role->description }}</td>
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
												<a href="{{ route('roles.edit', $role->id) }}">
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