@extends('layouts.sb-admin.master')

@section('content')

	<div class="block-header">
		<h2>Assessment Categories</h2>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<div class="row justify-content-end">
						<div class="col-md-4">
							<form>

								<div class="input-group mb-3">
  									<input type="text" class="form-control" placeholder="Please enter category name" aria-label="Please enter category name" aria-describedby="button-addon2">
								  	<div class="input-group-append">
								    	<button class="btn btn-info btn-sm" type="button" id="button-addon2">
								    		<i class="fa fa-plus"></i>
								    		<span>add</span>
								    	</button>
								  	</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $category)
								<tr>
									<td>{{ $category->id }}</td>
									<td>{{ $category->name }}</td>
									<td>
										<a href="#">
											<i class="fa fa-edit"></i>
										</a> | 
										<a href="#">
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

@stop