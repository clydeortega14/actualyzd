@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12">
				<h4 class="text-center">Permissions</h4>
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
						<a href="{{ route('permissions.create') }}" class="btn btn-info btn-sm float-right">
							<i class="fa fa-plus"></i>
							<span>Add Permission</span>
						</a>
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
										<tr>
											<td>
												<span class="{{ $permission->class }}">{{ $permission->name }}</span>
											</td>
											<td>{{ $permission->display_name }}</td>
											<td>{{ $permission->description }}</td>
											<td>
												<a href="{{ route('permissions.edit', $permission->id) }}">
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