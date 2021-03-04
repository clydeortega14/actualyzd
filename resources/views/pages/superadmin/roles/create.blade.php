@extends('layouts.sb-admin.master')


@section('content')

	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Create Role</h1>


		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						@php
							$hasRole = isset($role) ? true : false;
						@endphp
						<form action="{{ route('roles.store') }}" method="POST">
							@csrf
						<div class="row justify-content-between">
							<div class="col-sm-5">
								
								<div class="form-group">
									<label>Name <small class="text-danger">(required)</small></label>
									<input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $hasRole ? $role->name : old('name') }}" required {{  $hasRole ? 'disabled' : ''}}>
								</div>

								<div class="form-group">
									<label>Display Name <small>(Optional)</small></label>
									<input type="text" name="display_name" class="form-control" placeholder="Enter Display Name" value="{{ $hasRole ? $role->display_name : old('display_name') }}" required>
								</div>


								<div class="form-group">
									<label>Description <small>(Optional)</small></label>
									<textarea class="form-control" rows="4" cols="10" name="description" placeholder="Enter Description">{{ $hasRole ? $role->description : old('description') }}</textarea>
								</div>

								<div class="form-group d-flex justify-content-end">
									<a href="{{ route('roles.index') }}" class="btn btn-danger mr-2">Cancel</a>
									<button class="btn btn-primary">Submit</button>
								</div>
								
							</div>
							<div class="col-sm-5">
								
								<h3>Permissions</h3>
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th></th>
												<th>permission</th>
											</tr>
										</thead>

										<tbody>
											<tr>
												<td><input type="checkbox" name="permissions[]"></td>
												<td>
													<span class="badge badge-primary">can.view.dashboard</span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop