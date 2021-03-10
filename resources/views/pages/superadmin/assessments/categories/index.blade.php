@extends('layouts.sb-admin.master')

@section('content')

	<div class="block-header">
		<h2>Assessment Categories</h2>
	</div>

	{{ Breadcrumbs::render('categories.index') }}

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<a href="{{ route('categories.create') }}" class="btn btn-info btn-sm float-right">
						<i class="fa fa-plus"></i>
						<span>Create Category</span>
					</a>
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
										<a href="{{ route('categories.edit', $category->id) }}">
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