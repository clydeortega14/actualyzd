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
							<div class="form-group mb-4">

								<div class="form-check form-check-inline" v-for="(choice, index) in questionnaire.to_option.choices" :key="index">
									
									<input class="form-check-input" type="radio" :id="choice.id" :value="choice.value" v-model="chosen_choice[questionnaire.id]" @change="selectChoice">

									<label class="form-check-label" for="mc-one-never">{{ choice.display_name }}</label>

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
	
	export default {

		data(){

			return {

				chosen_choice: [],
				is_firstimer: null
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
			selectChoice()
			{
				this.$emit('onboarding-answers', [this.chosen_choice, this.is_firstimer])
			}
		}
	}
</script>

<style scoped>
	.roman {

		list-style-type: upper-roman;
	}
</style>