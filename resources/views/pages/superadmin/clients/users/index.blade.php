@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card mb-3">
					<div class="card-header">
						<div class="d-sm-flex justify-content-between">
							<div>{{ $client->name }} Users</div>
							<div>
								<a href="{{ route('client.user.create') }}" class="btn btn-primary">
									<i class="fa fa-plus"></i>
									<span>Add User</span>
								</a>
							</div>
						</div>
						
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th></th>
										<th>Name</th>
										<th>Email</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									@foreach($client->users as $user)
										<tr>
											<td></td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>
												<span class="{{ $user->is_active ? 'badge badge-primary' : 'badge badge-secondary'}}">
													{{ $user->is_active ? 'Active' : 'Inactive' }}
												</span>
											</td>
											<td>
												<a href="#" class="btn btn-{{ $user->is_active ? 'secondary' : 'primary' }} btn-sm"
													data-toggle="modal" data-target="#update-status-{{ $user->id}}">
													<i class="fa fa-eye"></i>
												</a> |

												@include('pages.superadmin.clients.users.modals.update-status')

												<a href="#" class="btn btn-secondary btn-sm">
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