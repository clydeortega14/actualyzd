@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row mb-3">
			<div class="col-md-12">
				<h3>Manage Members</h3>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						All Members
						<a href="" class="btn btn-primary float-right">
							<i class="fa fa-plus"></i>
							<span>Create New Member</span>
						</a>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<div class="row">
								<div class="col-md-6">
									{{ $members->links() }}
								</div>
								<div class="col-md-6">
									<input type="text" name="search" class="form-control" placeholder="Seach Member...">
								</div>
							</div>
							

							<table class="table mt-3">
								<thead>
									<tr>
										<th></th>
										<th>Company</th>
										<th>Name</th>
										<th>Email</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($members as $member)
										@php
                                            $isActive = $member->is_active;
                                        @endphp
										<tr>
											<td>
												<a href="{{ route('user.profile', auth()->user()->id) }}">
                                                  <img src="{{ is_null($member->avatar) || !file_exists(public_path().'/storage/'.$member->avatar) ? '/images/profile.png' : asset('storage/'.$member->avatar) }}" height="48" width="48" class="img-circle">
                                                </a>
											</td>
											<td>
												<a href="#">
                                                  <img src="{{ is_null($member->client->logo) || !file_exists(public_path().'/storage/'.$member->client->logo) ? '/images/logo1.png' : asset('storage/'.$member->client->logo) }}" height="48" width="48" class="img-circle">
                                                </a>
											</td>
											<td>{{ $member->name }}</td>
											<td>{{ $member->email }}</td>
											<td>
												<span class="badge {{ $isActive ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $isActive ? 'Active' : 'Inactive' }}
                                                </span>
											</td>
											<td>
												<a href="#" class="btn btn-sm {{ $isActive ? 'btn-danger' : 'btn-success' }} activate-button">
                                                    <i class="fa {{ $isActive ? 'fa-eye-slash' : 'fa-eye' }}"></i>
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