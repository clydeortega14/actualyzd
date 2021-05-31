@extends('layouts.app')


@section('content')

	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">Create Permission</h1>


		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<div class="row justify-content-center">
							<div class="col-sm-5">
								@php
									$hasPermission = isset($permission) ? true : false;
								@endphp
								<form action="{{ $hasPermission ? route('permissions.update', $permission->id) : route('permissions.store') }}" method="POST">
									@csrf
									@if($hasPermission)
										@method('PUT')
									@endif
								
									<div class="form-group">
										<label>Name <small class="text-danger">(required)</small></label>
										<input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $hasPermission ? $permission->name : old('name') }}" required {{ $hasPermission ? 'disabled' : ''}}>
									</div>

									<div class="form-group">
										<label>Display Name <small>(Optional)</small></label>
										<input type="text" name="display_name" class="form-control" value="{{ $hasPermission ? $permission->display_name : old('display_name') }}" placeholder="Enter Display Name">
									</div>


									<div class="form-group">
										<label>Description <small>(Optional)</small></label>
										<textarea type="text" name="description" class="form-control" placeholder="Enter Description" rows="4" cols="10">{{ $hasPermission ? $permission->description : old('description') }}</textarea>
									</div>
									
									<div class="form-group d-flex justify-content-end">
										<a href="{{ route('permissions.index') }}" class="btn btn-danger mr-2">Cancel</a>
										<button class="btn btn-primary">Submit</button>
									</div>
								</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

@stop