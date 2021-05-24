@extends('layouts.sb-admin.master')

@section('content')
	
	<h1 class="h3 mb-3 text-gray-800">Assessment Categories</h1>
	{{ Breadcrumbs::render('categories.create') }}

	<div class="row">

		<div class="col-sm-4">
			<div class="card mb-3">
				<div class="card-header">
					category
				</div>

				<div class="card-body">
					<div class="form-group">
						<label for="name">Category Name</label>
						<input type="text" name="cat_name" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="name">Description</label>
						<input type="text" name="cat_description" class="form-control" required>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-info">Submit</button>
						<a href="{{ route('categories.index') }}" class="btn btn-danger">Cancel</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-8">
			<div class="card mb-3">
				<div class="card-header">
					questionnaiers
				</div>

				<div class="card-body">
					<div class="d-sm-flex justify-content-end align-items-center mb-3">
						<button class="btn btn-info btn-sm" type="button">
							<i class="fa fa-plus"></i>
						    <span>Add Question</span>
					   </button>
					</div>

					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Question</th>
									<th>Option</th>
								</tr>
							</thead>

							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop