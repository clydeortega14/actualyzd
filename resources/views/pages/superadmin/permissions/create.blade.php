@extends('layouts.app')


@section('content')

	<div class="container-fluid">


		<div class="row">
			<div class="col-md-12">
				<h4 class="text-center">Create Permission</h4>
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
				<a href="{{ route('permissions.index') }}" class="btn btn-outline-info mr-2 mb-3">
					<i class="fa fa-clipboard-check"></i>
					<span>Permissions</span>
				</a>
			</div>
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