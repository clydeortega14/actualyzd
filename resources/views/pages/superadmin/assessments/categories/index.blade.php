@extends('layouts.sb-admin.master')

@section('content')

	<h1 class="h3 mb-3 text-gray-800">Assessment Categories</h1>

	{{ Breadcrumbs::render('categories.index') }}

	@include('alerts.message')

	<div class="row" id="parent">
		<div class="col-sm-4">
			<div class="card mb-3">
				<div class="card-header">
					All categories
				</div>
				<div class="card-body">
					<form action="{{ route('categories.store') }}" method="POST">
						@csrf
						<div class="input-group mb-3">
							<input type="text" class="form-control" name="assessment_category" placeholder="Enter Category" aria-label="Enter Category" aria-describedby="button-addon2" required>
						  	<div class="input-group-append">
						    	<button class="btn btn-info btn-sm" type="submit" id="button-addon2">
						    		<i class="fa fa-plus"></i>
						    		<span>add Category</span>
						    	</button>
						  	</div>
						</div>
					</form>

					<div class="clearfix"></div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th></th>
								</tr>
							</thead>

							<tbody>
								@foreach($categories as $category)
									<tr>
										<td>
											<a href="#" class="category-button" data-id="{{ $category->id}}">{{ $category->name }}</a>
										</td>
										<td>
											<a href="#" class="category-modal" data-toggle="modal" data-target="#category-edit" data-id="{{ $category->id }}"><i class="fa fa-edit"></i></a> |
											<a href="{{ route('categories.index') }}" class="delete-category" category-name="{{ $category->name }}"><i class="fa fa-trash"></i></a>

											<form id="category-delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST">
												@csrf @method('DELETE')
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@include('pages.superadmin.assessments.categories.modals.category-modal-edit')
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
						<a href="#" class="btn btn-info btn-sm float-right mb-2 new-question-modal" data-toggle="modal" data-target="#new-question">
							<i class="fa fa-plus"></i>
							<span>New Question</span>
						</a>

						@include('pages.superadmin.assessments.categories.modals.new-question')
						<table class="table">
							<thead>
								<tr>
									<th>Question</th>
									<th>Option</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="table-questionnaires"></tbody>
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
	});

	function choicesTemp(choice)
	{
		return `
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="${choice.value}" id="${choice.id}" disabled checked>
			  <label class="form-check-label" for="${choice.id}">
			    ${choice.display_name}
			  </label>
			</div>
		`;
	}

	const custom_ajax = new Ajax();
	const sweetAlert = new SweetAlert;

	// Categories module
	const categories = {
		initialize(){
			this.dom();
			this.events();
		},

		events(){
			let this_global = this;

			// category delete
			this.$btn_deleteButton.on('click', function(e) {

				e.preventDefault();

				let $this = $(this);

				let categoryName = $this.attr('category-name');

				sweetAlert.confirmDialog2('Delete ' + categoryName + '?').then((result) => {

					if(result.isConfirmed) {
						$this.closest('tr').find('form').submit();
					} else {
						sweetAlert.cancel('Category was not deleted!');
					}
				});
			});

			// category Edit
			this.$btn_categoryEdit.on('click', function(e) {

				e.preventDefault();

				let editRoute = `{{ route('categories.edit', ':id') }}`;
				let updateRoute = `{{ route('categories.update', ':id') }}`;
				let categoryId = $(this).data('id');

				editRoute = editRoute.replace(':id', categoryId);
				updateRoute = updateRoute.replace(':id', categoryId);

				$.get(editRoute, function(data) {
					console.log(data);
					$('#category-name-edit').val(data.name);
					$('#category-edit-form').attr('action', updateRoute);
				});
			});
		},
		parent: $('#parent'),
		dom() {
			this.$btn_deleteButton = this.parent.find('.delete-category')
			this.$btn_categoryEdit = this.parent.find('.category-modal')
		}
	};

	//Questionnaires module
	const questionnaire = {

		initialize(){
			this.render();
			this.dom();
			this.events();
		},
		render()
		{
			this.getQuestionnaire()
		},
		events(){
			let this_global = this;
			// questionnaire by category
			this.$btn_category.on('click', function(e){
				e.preventDefault();
				let $this = $(this);
				let category = $this.attr('data-id');
				let config = {
					url: '/set-up/assessment/questionnaires',
					method: 'GET',
					async: false,
					data: {
						category,
					} 
				}
				this_global.iterateQuestions(config);
			});

			// delete question
			$('body').on('click', '.delete-question', function(e) {
				
				e.preventDefault();

				let $this = $(this);

				sweetAlert.confirmDialog2('Do you want to delete this question?').then((result) => {

					if(result.isConfirmed) {
						$this.closest('tr').find('form').submit();
					} else {
						sweetAlert.cancel('Question was not deleted!');
					}
				});
			});

			// add new question - when clicked the form in modal will be reset
			this.$btn_newQuestion.on('click', function() {
				$('#question-form').trigger("reset");
				$('.modal-title').html('Add New Question');
				$('.choices-lists').empty();
			});

			// edit question
			$('body').on('click', '.question-modal', function(e) {

				e.preventDefault();

				let $choices_lists = $('#choices-lists')
				let $option_choices = $('#option-choices')
				let editRoute = `{{ route('questionnaires.edit', ':id') }}`;
				let updateRoute = `{{ route('questionnaires.update', ':id') }}`;
				let questionId = $(this).data('id');

				editRoute = editRoute.replace(':id', questionId);
				updateRoute = updateRoute.replace(':id', questionId);

				$.get(editRoute, function(data) {

					$('.modal-title').html('Edit Question');
					$('#category').val(data.category.id);
					$('#question').val(data.question);
					$('#question-option').val(data.to_option.id);

					const choices = options.find(option => option.id == data.to_option.id).choices;
					$option_choices.show();
					$choices_lists.empty();
					choices.forEach((choice, index) => {
						$choices_lists.append(choicesTemp(choice));
					})

					$('#question-form').attr('action', updateRoute);
					$('#question-form').prepend('<input type="hidden" name="_method" value="PUT">');

				});
			});

		},
		getQuestionnaire(){

			let config = {
				url: '/set-up/assessment/questionnaires',
				method: 'GET'
			}
			this.iterateQuestions(config)
		},
		iterateQuestions(config)
		{
			return custom_ajax.request(config).done(questionnaires => {
				
				this.$table_questionnaires.empty();
				questionnaires.forEach((question, index) => {
					this.$table_questionnaires.append(this.questionnaireTemp(question))
				})
			});
		},

		questionnaireTemp(question){

			let destroyRoute =  `{{ route('questionnaires.destroy', ':id') }}`;
			destroyRoute = destroyRoute.replace(':id', question.id);

			return `
				<tr>
					<td>${question.question}</td>
					<td>${question.to_option.name}</td>
					<td>
						<a href="" class="question-modal" data-toggle="modal" data-target="#new-question" data-id="${question.id}">
							<i class="fa fa-edit"></i>
						</a> | 
						<a href="{{ route('categories.index') }}" class="delete-question" question-id="${question.id}">
							<i class="fa fa-trash"></i>
						</a>

						<form id="delete-question-${question.id}" action="${destroyRoute}" method="POST">
							@csrf @method('DELETE')
						</form>
					</td>
				</tr>

			`;

		},
		parent: $('#parent'),
		dom() {
			this.$table_questionnaires = this.parent.find('#table-questionnaires')
			this.$btn_category = this.parent.find('.category-button')
			this.$btn_newQuestion = this.parent.find('.new-question-modal')
		}
	};

	categories.initialize();
	questionnaire.initialize();
</script>

@endsection