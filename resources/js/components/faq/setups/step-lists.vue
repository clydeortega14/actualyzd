<template>
	<div>
		<div v-if="steps.length > 0">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Description</th>
							<th>Link</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(step, index) in steps" :key="index">
							<td>
								{{ step.description }}
								<input type="hidden" name="steps[description][]" :value="step.description">
							</td>
							<td>
								<a :href="step.link" target="_blank">{{ step.link }}</a>
								<input type="hidden" name="steps[link][]" :value="step.link">
							</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div v-else>
			<h5 class="card-title text-center text-gray">No Steps / Procedure</h5>
		</div>
	</div>
</template>


<script>
	
	import { mapGetters } from 'vuex';

	export default {
		name: "StepLists",
		data() {

			return {
				steps: []
			}
		},
		computed: {

			...mapGetters(["getFaqSteps"])
		},
		created(){

			// this.steps = [
			// 	{description: 'Click Book A Session button in the upper right corner of your homepage', link: 'http://localhost:8000/book'},
			// 	{description: 'Click Book A Session button', link: ''},
			// 	{description: 'Answer the onboarding questions.', link: ''},
			// ];

			// console.log(this.getFaqSteps)


			EventBus.$on('submit-step', (data) => {

				this.steps.push(data);
				
			});
		},

	}
</script>