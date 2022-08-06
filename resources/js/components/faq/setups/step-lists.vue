<template>
	<div>

		<input type="hidden" name="step_id" v-model="step_id">

		<div v-if="faq_steps_lists.length > 0">
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
						<tr v-for="(step, index) in faq_steps_lists" :key="index">
							<td>
								{{ step.description }}
								<input type="hidden" name="steps[description][]" :value="step.description">
							</td>
							<td>
								<div v-if="step.link != null">
									<a :href="step.link" target="_blank">Click Me!</a>
								</div>
								<input type="hidden" name="steps[link][]" :value="step.link">
							</td>
							<td>
								<a href="#" class="mr-2" @click.prevent="editStep(step)">
									<i class="fas fa-edit"></i>
								</a> 
								<a href="#">
									<i class="fas fa-trash"></i>
								</a> 
							</td>
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
	
	import { mapGetters, mapActions } from 'vuex';

	export default {
		name: "StepLists",
		data(){
			return {
				step_id: null,
				faq_steps_lists: []
			}
		},
		props: {

			faqId: String
		},
		computed: {

			...mapGetters(["getFaqSteps"])
		},
		created(){

			EventBus.$on('submit-step', (data) => {

				if(this.step_id != null){

					let index = this.faq_steps_lists.findIndex(faq_step => faq_step.id == this.step_id);

					if(index > -1){

						this.faq_steps_lists.splice(index, 1, data);
					}
				}else{

					this.faq_steps_lists.push(data);

				}

			});


			if(this.faqId != ''){

				this.getFaqById(this.faqId);
			}
		},
		methods: {

			getFaqById(faq_id){

				axios.get(`/FAQs/get/faq/steps/${faq_id}`)
				.then(response => {
					this.faq_steps_lists = response.data.steps;
				})
				.catch(error => console.log(error))
			},
			editStep(step){

				this.step_id = step.id;
				EventBus.$emit('edit-step', step);
			}
		}

	}
</script>