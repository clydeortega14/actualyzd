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
						<a href="#" class="btn btn-info btn-sm float-right mb-2" data-toggle="modal" data-target="#new-question">
							<i class="fa fa-plus"></i>
							<span>New Question</span>
						</a>

						@include('pages.superadmin.assessments.categories.modals.new-category')
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

@section('js_scripts')
<script>

	let options = @json($options);
	let editmode = false;

	$(function(){

		let $option_choices = $('#option-choices')
		let $choices_lists = $('#choices-lists')
		$option_choices.hide()

		$('select[name="option"]').change(function(){

			let id = $(this).find('option:selected').val();
			const choices = options.find(option => option.id == id).choices;
			$option_choices.show()
			$choices_lists.empty()
			choices.forEach((choice, index) => {
				$choices_lists.append(choicesTemp(choice));
			})
		})

		$(document).on('click', '.edit-choice', function(e){
			e.preventDefault()
			let $this = $(this);
			let data_id = $this.attr('data-id');
			let edit_fields = [`#choice-value-${data_id}`, `#choice-display-name-${data_id}`]

			editChoice($this, edit_fields);
			
		})
	})

	function editChoice(fn, editable_fields)
	{
		if(fn.attr('editing') != '1'){
			let buttons = $(`
					<button type="submit" class="btn btn-sm btn-primary">
						<i class="fa fa-check"></i>
					</button>
				`)

			fn.attr('editing', 1);
			fn.replaceWith(buttons)
			if(Array.isArray(editable_fields)){
				editable_fields.forEach((dom, index) => {
					edit(dom)
				})
			}else{

				editable(editable_fields)
			}
		}else{

			fn.removeAttr('editing');
		}
	}

	function savedChanges()
	{
		let saved = $('<span class="pr-3 editable" />').text($())
	}

	function edit(dom)
	{
		let input = $('<input type="text" class="editing" />').val($(this).text());
		editable(dom, input);
	}

	function editable(dom, editable)
	{
		$(document).find(dom).each(function(){
			$(this).replaceWith(editable)
		});
	}

	function choicesTemp(choice)
	{
		return `
			
			<div class="d-sm-flex align-items-center justify-content-between mt-4 border-bottom" id="choice-field-${choice.id}">
    			<div>
    				<span class="pr-3 editable" id="choice-value-${choice.id}">${choice.value}</span>
    				<span class="editable" id="choice-display-name-${choice.id}">${choice.display_name}</span>
    			</div>
    			<div>
    				<a href="#"><i class="fa fa-edit edit-choice" data-id="${choice.id}"></i></a>
    				<a href="#"><i class="fa fa-trash"></i></a>
    			</div>
    		</div>
		`;
	}
</script>

@endsection