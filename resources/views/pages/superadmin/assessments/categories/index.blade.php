@extends('layouts.sb-admin.master')

@section('content')

	<h1 class="h3 mb-3 text-gray-800">Assessment Categories</h1>

	{{ Breadcrumbs::render('categories.index') }}

	<div class="row" id="parent">
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
											<a href="#" class="category-button" data-id="{{ $category->id}}">{{ $category->name }}</a></td>
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

			return `
				<tr>
					<td>${question.question}</td>
					<td>${question.to_option.name}</td>
					<td></td>
				</tr>

			`;

		},
		parent: $('#parent'),
		dom() {

			this.$table_questionnaires = this.parent.find('#table-questionnaires')
			this.$btn_category = this.parent.find('.category-button')
		}
	}

	questionnaire.initialize();
</script>

@endsection