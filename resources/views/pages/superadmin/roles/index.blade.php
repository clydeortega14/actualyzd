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
										<th>Permission</th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									@foreach($roles as $role)
										<tr>
											<td>{{ $role->name }}</td>
											<td>N/A</td>
											<td></td>
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