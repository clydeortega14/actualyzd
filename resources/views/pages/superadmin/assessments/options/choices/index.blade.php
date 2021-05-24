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
							<form action="{{ route('optionChoices.store') }}" method="POST">
								@csrf
								<input type="hidden" name="choice_id" value="{{ $option->id }}">
								<div class="form-group">
									<label>Value</label>
									<input type="text" name="choice_value" class="form-control" placeholder="Please Enter value" required>
								</div>

								<div class="form-group">
									<label>Display Name</label>
									<input type="text" name="choice_display_name" class="form-control" placeholder="Please enter display name" required>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-info">Submit</button>
									<a href="{{ route('options.index') }}" class="btn btn-danger">Cancel</a>
								</div>
							</form>
						</div>
						<div class="col-sm-8">
							@include('alerts.message')
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
											
											@foreach($option->choices as $choice)
												<tr>
													<td>{{ $choice->value }}</td>
													<td class="choice-name">{{ $choice->display_name }}</td>
													<td>
														<a href="" class="choice-modal" data-toggle="modal" data-target="#choice-edit" data-id="{{ $choice->id }}">
															<i class="fa fa-edit"></i>
														</a> |
														<a href="{{ route('options.show', $option->id) }}" class="delete-choice" choice-id="{{ $choice->id }}">
															<i class="fa fa-trash"></i>
														</a>

														<form id="delete-choice-{{ $choice->id }}" action="{{ route('optionChoices.destroy', $choice->id) }}" method="POST">
															@csrf @method('DELETE')
															<input type="hidden" name="cId" value="{{ $option->id }}">
														</form>

													</td>
												</tr>
											@endforeach
											
										</tbody>
									</table>

									@include('pages.superadmin.assessments.modal.choice-modal-edit')
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

@section('js_scripts')
	
	<script>
		
		$(function() {

			const sweetAlert = new SweetAlert;

			$('.delete-choice').on('click', function(e) {

				// prevent <a href> tag to run default function
				e.preventDefault();

				// find row name and store it on a variable
				let choiceName = $(this).closest('tr').find('td.choice-name').text();

				// show dialog when <a href> tag was clicked
				sweetAlert.confirmDialog2('Delete this choice?').then((result) => {

					// if true - submit deletion
					if(result.isConfirmed) {
						// get closest row and find form to submit
						$(this).closest('tr').find('form').submit();
					} else { // show dialog - deletion cancelled
						sweetAlert.cancel('Choices was not deleted!')
					}

				});
			});


			$('body').on('click', '.choice-modal', function(e) {

				e.preventDefault();

				let editRoute = `{{ route('optionChoices.edit', ':id') }}`;
				let updateRoute = `{{ route('optionChoices.update', ':id') }}`;
				let choiceId = $(this).data('id');

				editRoute = editRoute.replace(':id', choiceId);
				updateRoute = updateRoute.replace(':id', choiceId);
				
				$.get(editRoute, function(data) {

					$('#optionchoice-id').val(data.option);
					$('#choice-id').val(data.id);
					$('#choice-value-edit').val(data.value);
					$('#choice-name-edit').val(data.display_name);
					$('#choice-edit-form').attr('action', updateRoute);

				});
			});

		});

	</script>

@endsection