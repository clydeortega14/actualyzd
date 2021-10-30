<template>
	<div>
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
				selected_psychologist: null
			}
		},
		computed: {
			...mapGetters(['allPsychologists', 'getSelectedDate'])
		},
		mounted(){

			EventBus.$on('select-time', data => {

				this.getPsychologists({

					date: this.getSelectedDate,
					time_id: data.id
				})
			})
		},
		methods: {

			...mapActions(["getPsychologists"])
		}
	}
</script>