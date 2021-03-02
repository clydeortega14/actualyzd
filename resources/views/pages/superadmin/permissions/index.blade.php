@extends('layouts.sb-admin.master')


@section('content')
	
	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Permissions</h1>

		<div class="row">
			<div class="col-sm-12">
				<div class="card shadow mb-4">
					<div class="card-header py-4">
						<a href="{{ route('permissions.create') }}" class="btn btn-info">Create Permission</a>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Display Name</th>
										<th>Description</th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									@foreach($permissions as $permission)
										<td>{{ $permission->name }}</td>
										<td>{{ $permission->display_name }}</td>
										<td>{{ $permission->description }}</td>
										<td></td>

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