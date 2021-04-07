<ol>
	@foreach($category->questionnaires as $questionnaire)
		

		<li>
			<input type="hidden" name="category_id[]" value="{{ $category->id }}">

			<h6><b>{{ $questionnaire->question}}</b></h6>

			@php
				$option = $questionnaire->toOption;
			@endphp

			<div class="form-group mb-4">
				@foreach($option->choices as $choice)
					@php
						$checked = '';
						$disabled = '';
					@endphp

					@if(isset($booking))
						@php
							$answer = $booking->assessmentAnswers()->where('questionnaire_id', $questionnaire->id)->first();
						@endphp

						@if(!is_null($answer) && $answer->answer == $choice->value)
							@php
								$checked = 'checked';
							@endphp
						@else

							@php
								$disabled = 'disabled';
							@endphp
						@endif
					@endif

					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="choice[{{ $questionnaire->id }}]" id="mc-one-never" value="{{ $choice->value }}" required {{ $checked }} {{ $disabled }}>
						<label class="form-check-label" for="mc-one-never">{{$choice->display_name }}</label>
					</div>
				@endforeach
			</div>
		</li>
	@endforeach
</ol>