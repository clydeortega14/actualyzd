<ol>
	@foreach($category->questionnaires as $questionnaire)
		<li>
			<input type="hidden" name="category_id[]" value="{{ $category->id }}">
			<p>{{ $questionnaire->question}}</p>

			@php
				$option = $questionnaire->toOption;
			@endphp

			<div class="form-group mb-4">
				@if(count($option->choices) > 0)
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
							<input class="form-check-input" type="radio" name="choice[{{ $questionnaire->id }}]" id="mc-one-never" value="{{ $choice->value }}" {{ auth()->user()->hasRole('member') ? 'required' : '' }} {{ $checked }} {{ $disabled }}>
							<label class="form-check-label" for="mc-one-never">{{$choice->display_name }}</label>
						</div>
					@endforeach
				@else
					<div class="form-group">
						<textarea name="choice[{{ $questionnaire->id }}]" id="" cols="5" rows="5" class="form-control"></textarea>
					</div>
				@endif
			</div>
		</li>
	@endforeach
</ol>