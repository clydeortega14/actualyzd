@extends('layouts.sb-admin.master')

@section('content')
	
	<div class="block-header">
		<h2>Assessment Option</h2>
	</div>

	{{ Breadcrumbs::render('options.index') }}

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row justify-content-end">
						<div class="col-sm-4">
							<form action="{{ route('options.store') }}" method="POST">
								@csrf
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="assessment_option" placeholder="Please enter option" aria-label="Please enter option" aria-describedby="button-addon2" required>
								  	<div class="input-group-append">
								    	<button class="btn btn-info btn-sm" type="submit" id="button-addon2">
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
					@include('alerts.message')
					<div class="table-responsive">
						<table id="options-table" class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th></th>
								</tr>
							</thead>

							<tbody>
								@foreach($options as $option)
									<tr>
										<td>{{ $option->id}}</td>
										<td class="option-name">{{ $option->name }}</td>
										<td>
											<a href="" class="open-modal" data-toggle="modal" data-target="#option-edit" data-id="{{ $option->id }}">
												<i class="fa fa-edit"></i>
											</a> |
											<a href="{{ route('options.index') }}" class="delete-option" option-id="{{ $option->id }}">
												<i class="fa fa-trash"></i>
											</a> |
											<a href="{{ route('options.show', $option->id) }}" data-toggle="tooltip" data-placement="top" title="{{ count($option->choices) }} choices">
												<i class="fa fa-cubes"></i>
											</a>
											<form id="delete-form-{{ $option->id }}" action="{{ route('options.destroy', $option->id) }}" method="POST">
												@csrf @method('DELETE')
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>

						@include('pages.superadmin.assessments.modal.option-modal-edit')
					</div>
				</div>
			</div>
		</div>
	</div>

@stop

@section('js_scripts')

	<script>
		
		$(function() {

			const sweetAlert = new SweetAlert;

			$('.delete-option').on('click', function(e) {

				// prevent <a href> tag to run default function
				e.preventDefault();

				// find row name and store it on a variable
				let optionName = $(this).closest('tr').find('td.option-name').text();

				// show dialog when <a href> tag was clicked
				sweetAlert.confirmDialog2('Delete ' + optionName + '?').then((result) => {

					// if true - submit deletion
					if(result.isConfirmed) {
						// get closest row and find form to submit
						$(this).closest('tr').find('form').submit();
					} else { // show dialog - deletion cancelled
						sweetAlert.cancel('Option was not deleted!')
					}

				});
			});

			$('body').on('click', '.open-modal', function(e) {

				e.preventDefault();

				let editRoute = `{{ route('options.edit', ':id') }}`;
				let updateRoute = `{{ route('options.update', ':id') }}`;
				let optionId = $(this).data('id');

				editRoute = editRoute.replace(':id', optionId);
				updateRoute = updateRoute.replace(':id', optionId);

				$.get(editRoute, function(data) {
					
					$('#option-id-edit').val(data.id);
					$('#option-id-name').val(data.name);
					$('#option-edit-form').attr('action', updateRoute);

				});

			});

		});

	</script>

@endsection