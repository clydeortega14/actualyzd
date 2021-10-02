<template id="time-psych">
	
	<div class="modal fade" id="timePsych" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="timePsychLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="timePsychLabel">Select Time and Psychologists</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 border-right">
							<h5 class="card-title text-center mb-3">Select Time</h5>
							<div class="custom-control custom-radio mb-3 ml-3" v-for="(time, index) in timeLists" :key="index">
								<input type="radio" name="time" class="custom-control-input" :id="`time-${time.time_list.id}`" :value="time.time_list.id" v-model="selected_time">
								<label class="custom-control-label" :for="`time-${time.time_list.id}`">{{ `${time.time_list.from} - ${time.time_list.to}` }}</label>
							</div>
							
						</div>

						<div class="col-md-6">
							<h5 class="card-title text-center mb-3">Select Psychologist</h5>
							<div class="custom-control custom-radio mb-3 ml-3" v-for="(psychologist, index) in allPsychologists">
								<input type="radio" name="psychologist" class="custom-control-input" :id="`psychologist-${psychologist.id}`" :value="psychologist.id" v-model="selected_psychologist">
								<label class="custom-control-label" :for="`psychologist-${psychologist.id}`">{{ psychologist.name }}</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</template>


<script>
	
	import { mapGetters, mapActions } from 'vuex';

	export default {
		name: "TimePsych",
		data(){

			return {

				selected_time: null,
				selected_psychologist: null
			}
		},
		props: {
			timeLists: Array,
			selectedDate: String
		},
		computed: {
			...mapGetters([
				"allPsychologists"
			])
		},
		methods: {

			...mapActions([
				"getPsychologists"
			])
		},
		watch: {

			selected_time(value){

				this.selected_psychologist = null

				this.getPsychologists({
					date: this.selectedDate,
					time_id: value
				})
			}
		}
	}
</script>