<style scoped>
	.psych-name {

		display: inline-block;
	}
	.psych-container {

		border-style: double;
		border-color: #7386D5;
		border-radius: 5px;
		padding: 8px;
		cursor: pointer;
	}
	.psych-container a {

		color: #7386D5;
	}
	.psych-container:hover {

		background-color: #7386D5;
		border-style: double;
		border-color: #fff;
		color: #fff;
	}

	.psych-container:hover a {
		color: #fff;
	}

	.psych-container:hover img {
		border: 2px solid #fff;
	}

	.selected {

		background-color: #7386D5;
		border-style: double;
		border-color: #fff;
		color: #fff;
	}

	.selected a {

		color: #fff;
	}

	.selected img {
		border: 2px solid #fff;	
	}

</style>


<template>
	<div>
		
		<div v-if="show_psychologist_component && allPsychologists.length > 0">
			<h5 class="card-title mb-3 border-bottom">Select Psychologist</h5>
			<div class="row">
				<div class="col-md-12" v-for="(psychologist, index) in allPsychologists">

					<div class="psych-container" :class="{ selected: getSelectedPsychologistId === psychologist.id}" @click="selectPsychologist({ id: psychologist.id, name: psychologist.name })">
						<img src="/images/profile.png" alt="Profile" class="mr-3 rounded-circle" height="65" width="65">
						<div class="psych-name">
							{{ psychologist.name }}
							<!-- <a href="#" class="ml-3 float-right">
								<i class="fa fa-eye"></i>
							</a> -->
						</div>
					</div>

				</div>
			</div>
		</div>
		<p class="text-center text-danger" v-else>No Assignees Available!</p>
	</div>
</template>

<script>
		
	import { mapGetters, mapActions } from 'vuex';

	export default {
		name: "Psychologists",
		data(){
			return {
				selected_psychologist: null,
				show_psychologist_component: false
			}
		},
		computed: {
			...mapGetters(['allPsychologists', 'getSelectedDate', 'getSelectedPsychologist', 'getSelectedPsychologistId'])
		},
		mounted(){

			EventBus.$on('select-time', data => {

				this.getPsychologists({
					date: this.getSelectedDate,
					time_id: data.id
				})
				.then(response => {

					this.$store.commit('setPsychologists', response.data);

					if(response.data.length > 0){

						this.show_psychologist_component = true

						if(this.getSelectedPsychologistId !== null && this.show_psychologist_component){

						this.show_psychologist_component = false;
						this.selected_psychologist = null;
						this.$store.commit('setSelectedPsychologistId', null);
						this.$store.commit('setSelectedPsychologist', null);
						}
					}
				})
				.catch(err => console.log(err))
			})

			EventBus.$on('on-rescheduled-success', data => {
				this.show_psychologist_component = false;
			})
		},
		methods: {

			...mapActions(["getPsychologists"]),
			selectPsychologist(value){

				if(!_.isNil(value)){

					this.$store.commit('setSelectedPsychologistId', value.id);
					this.$store.commit('setSelectedPsychologist', value.name);

					EventBus.$emit('select-psychologist', value);

				}
			}
		}
	}
</script>