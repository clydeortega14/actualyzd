@extends('layouts.sb-admin.master')

@section('content')

	<div class="block-header">
		<h2>{{ $option->name }} Choices</h2>
	</div>

	<div class="row">
		<div class="col-sm-12">

			{{ Breadcrumbs::render('options.show', $option) }}
			
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4 border-right">
							<form>
								<div class="form-group">
									<label>Value</label>
									<input type="text" name="value" class="form-control" placeholder="Please Enter value">
								</div>

								<div class="form-group">
									<label>Display Name</label>
									<input type="text" name="display_name" class="form-control" placeholder="Please enter display name">
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-info">Submit</button>
									<a href="{{ route('options.index') }}" class="btn btn-danger">Cancel</a>
								</div>
							</form>
						</div>
						<div class="col-sm-8">
							@if(count($option->choices) > 0)
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Value</th>
												<th>Display Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											
											@foreach($option->choices as $option)
												<tr>
													<td>{{ $option->value }}</td>
													<td>{{ $option->display_name }}</td>
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
							@else
								<div class="text-center">
									<h5>No Choices Available!</h5>
								</div>
							@endif

						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

@stop