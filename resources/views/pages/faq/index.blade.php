@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">FAQ's</h1>
		{{ Breadcrumbs::render() }}

		<div class="card mb-3">
			<div class="card-header">
				<div class="d-flex justify-content-between">
					All Questions
					<a href="{{ route('faqs.create') }}" class="btn btn-primary btn-sm">
						<i class="fa fa-plus"></i>
					</a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Title</th>
								<th>Description</th>
								<th>steps</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($faqs as $faq)
								<tr>
									<td>{{ $faq->id }}</td>
									<td>{{ $faq->title }}</td>
									<td>{{ $faq->description }}</td>
									<td>{{ count($faq->steps) }}</td>
									<td align="right">
										<a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-secondary btn-sm">
											<i class="fa fa-edit"></i>
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

@stop