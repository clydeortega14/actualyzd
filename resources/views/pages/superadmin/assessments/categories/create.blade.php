@extends('layouts.sb-admin.master')

@section('content')
	
	<div class="block-header">
		<h2>Assessment Category</h2>
	</div>

	{{ Breadcrumbs::render('categories.create') }}

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					create
				</div>

				<div class="card-body">
					<div class="form-group row mt-4">
						<label for="name" class="col-form-label col-sm-4 text-md-right">{{ __('Name') }}</label>
						<div class="col-sm-6">
							<input type="text" name="name" class="form-control">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop