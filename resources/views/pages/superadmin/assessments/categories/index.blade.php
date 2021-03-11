@extends('layouts.sb-admin.master')

@section('content')

	<h1 class="h3 mb-3 text-gray-800">Assessment Categories</h1>

	{{ Breadcrumbs::render('categories.index') }}

	<div class="row">
		<div class="col-sm-4">
			<div class="card mb-3">
				<div class="card-header">
					All categories
				</div>
				<div class="card-body">
					<a href="{{ route('categories.create') }}" class="btn btn-info btn-sm float-right mb-2">
						<i class="fa fa-plus"></i>
						<span>New Category</span>
					</a>
					<div class="clearfix"></div>


					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Description</th>
									<th></th>
								</tr>
							</thead>

							<tbody>
								@foreach($categories as $category)
									<tr>
										<td>
											<a href="#">{{ $category->name }}</a></td>
										<td></td>
										<td>
											<a href="#"><i class="fa fa-bars"></i></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-8 mb-3">
			<div class="card mb-3">
				<div class="card-header">
					Questionnaires
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<a href="{{ route('categories.create') }}" class="btn btn-info btn-sm float-right mb-2">
							<i class="fa fa-plus"></i>
							<span>New Question</span>
						</a>
						<table class="table">
							<thead>
								<tr>
									<th>Question</th>
									<th>Option</th>
									<th></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop