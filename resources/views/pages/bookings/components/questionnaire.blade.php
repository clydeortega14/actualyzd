<ol>
	@foreach($category->questionnaires as $questionnaire)
		<li>
			<h6><b>{{ $questionnaire->question}}</b></h6>
			@php
				$option = $questionnaire->toOption;
			@endphp

			<div class="form-group mb-4">
				@foreach($option->choices as $choice)
				<input type="text" name="category_id[]" value="{{ $category->id }}">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="choice[{{ $questionnaire->id }}]" id="mc-one-never" value="{{ $choice->value }}" required>
						<label class="form-check-label" for="mc-one-never">{{$choice->display_name }}</label>
					</div>
				@endforeach
			</div>
		</li>
	@endforeach
</ol>