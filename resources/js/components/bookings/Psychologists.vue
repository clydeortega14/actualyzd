<template>
	<div v-if="show_psychologist_component">
		<h5 class="card-title mb-3 border-bottom">Select Psychologist</h5>

		<div class="custom-control custom-radio mb-3 ml-3" v-for="(psychologist, index) in allPsychologists">

			<input type="radio" class="custom-control-input" 
				:id="`psychologist-${psychologist.id}`"
				:value="{ id: psychologist.id, name: psychologist.name }"
				v-model="selected_psychologist">

			<label class="custom-control-label" :for="`psychologist-${psychologist.id}`">{{ psychologist.name }}</label>
		</div>
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
			...mapGetters(['allPsychologists', 'getSelectedDate', 'getSelectedPsychologist'])
		},
		mounted(){

			EventBus.$on('select-time', data => {

				if(this.selected_psychologist !== null && this.show_psychologist_component){

					this.show_psychologist_component = false;
					this.selected_psychologist = null;
					this.$store.commit('setSelectedPsychologistId', null);
					this.$store.commit('setSelectedPsychologist', null);

				}

				this.show_psychologist_component = true

				this.getPsychologists({
					date: this.getSelectedDate,
					time_id: data.id
				})


			})
		},
		methods: {

			...mapActions(["getPsychologists"])
		},
		watch: {

			selected_psychologist(value){

				if(!_.isNil(value)){

					this.$store.commit('setSelectedPsychologistId', value.id);
					this.$store.commit('setSelectedPsychologist', value.name);

					EventBus.$emit('select-psychologist', value);

				}

				
			}
		}
	}
</script>