<template>
	<div class="card mb-3 mt-3">
		<div class="card-header">
			Onboarding Questions
		</div>

		<div class="card-body">

			<div class="form-group mb-4 ml-4">
				<div class="form-check form-check-inline">
					<input type="radio" class="form-check-input" v-model="is_firstimer" :value="true" id="firstimer">
					<label class="form-check-label" for="firstimer">First Timer</label>
				</div>

				<div class="form-check form-check-inline">
					<input type="radio" class="form-check-input" v-model="is_firstimer" :value="false" id="repeater">
					<label class="form-check-label" for="repeater">Repeater</label>
				</div>
			</div>

			<ol class="roman">
				<li v-for="category in allQuestions" :key="category.id">
					<b>{{ category.name }}</b>
					<ol>
						<li v-for="(questionnaire, key) in category.questionnaires" :key="key">{{ questionnaire.question }}
							
							<div v-if="questionnaire.to_option.choices.length > 0">
								<div class="form-group mb-4">
									<div class="form-check form-check-inline" v-for="(choice, index) in questionnaire.to_option.choices" :key="index">
										
										<input class="form-check-input" type="radio" :id="choice.id" :value="choice.value" v-model="onboardingAnswers[questionnaire.id]" @change="onChanged">

										<label class="form-check-label" for="mc-one-never">{{ choice.display_name }}</label>

									</div>
								</div>
							</div>

							<div v-else class="col-sm-12">
								<div class="form-group mb-4">
									<textarea class="form-control" rows="3" :id="questionnaire.id" v-model="onboardingAnswers[questionnaire.id]" placeholder="Type your answer ..." v-on:keyup="onChanged"></textarea>
								</div>
							</div>
						</li>
					</ol>
				</li>
			</ol>
		</div>
	</div>
</template>

<script>

	import { mapGetters, mapActions } from 'vuex';
	import { debounce } from 'lodash';
	import { DEBOUNCE_DELAY_MS } from '../constants/App';
	
	let vm

	export default {

		data(){

			return {

				chosen_choice: [],
				is_firstimer: null,
				// Onboarding_answer: {
				// 	chosen_choice: [],
				// 	openEndedAnswer: []
				// }

				onboardingAnswers: [],
			}

		},

		computed: {

			...mapGetters(["allQuestions"])
		},
		created(){

			this.getQuestions()
		},
		methods: {
			...mapActions(["getQuestions"]),

			onChanged(event) {
				this.$emit('onboarding-answers', [this.is_firstimer, this.onboardingAnswers])
			},

			onChangedDebounced: debounce(event => {
	            return this.onChanged(event)
	        }, DEBOUNCE_DELAY_MS)
		}
	}
</script>

<style scoped>
	.roman {

		list-style-type: upper-roman;
	}
</style>