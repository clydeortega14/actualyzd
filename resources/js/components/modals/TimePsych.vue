<template id="time-psych">
	
	<div class="modal fade" id="timePsych" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="timePsychLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="timePsychLabel">Book A session</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 border-right">


							<h5 class="card-title text-center mb-3">Review Session Details</h5>

							<ReviewBooking 
								:has-assessment="hasAssessment"
								/>
						</div>
							
						<div class="col-md-6">

							<div v-if="show_time_lists" class="mb-3">
								<h5 class="card-title mb-3 border-bottom">Select Time</h5>
								<div class="custom-control custom-radio mb-3 ml-3" v-for="(time, index) in timeLists" :key="index">
									<input type="radio" name="time" class="custom-control-input" 
										:id="`time-${time.time_list.id}`" 
										:value="{ id: time.time_list.id, name: `${time.time_list.from} - ${time.time_list.to}`}" 
										v-model="selected_time">
									<label class="custom-control-label" :for="`time-${time.time_list.id}`">{{ `${time.time_list.from} - ${time.time_list.to}` }}</label>
								</div>
							</div>

							<div v-if="show_psychologists" class="mb-3">

								<h5 class="card-title mb-3 border-bottom">Select Psychologist</h5>

								<div class="custom-control custom-radio mb-3 ml-3" v-for="(psychologist, index) in allPsychologists">

									<input type="radio" name="psychologist" class="custom-control-input" 
										:id="`psychologist-${psychologist.id}`"
										:value="{ id: psychologist.id, name: psychologist.name }"
										v-model="selected_psychologist">

									<label class="custom-control-label" :for="`psychologist-${psychologist.id}`">{{ psychologist.name }}</label>
								</div>

							</div>

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary">
						<i class="fa fa-check"></i>
						<span>Submit Booking</span>
					</button>
				</div>
			</div>
		</div>
	</div>
	
</template>


<script>
	
	import { mapGetters, mapActions } from 'vuex';
	import ReviewBooking from '../bookings/ReviewBooking.vue'

	export default {
		name: "TimePsych",
		data(){

			return {

				selected_time: null,
				selected_psychologist: null,
				show_time_lists: true,
				show_psychologists: false
			}
		},
		props: {
			timeLists: Array,
			selectedDate: String,
			hasAssessment: Number
		},
		components: {

			ReviewBooking
		},
		computed: {
			...mapGetters([
				"allPsychologists",
				"getSelectedDate",
				"getSelectedTimeId",
				"getSelectedPsychologist"
			]),
			selectedPsychologist(){
				return this.$store.state.selected_psychologist
			}
		},
		methods: {

			...mapActions([
				"getPsychologists"
			])
		},
		watch: {

			selected_time(value){

				this.show_psychologists = true;

				this.$store.commit('setSelectedPsychologistId', null);
				this.$store.commit('setSelectedPsychologist', null);

				this.getPsychologists({
					date: this.selectedDate,
					time_id: value.id
				});

				this.$store.commit('setSelectedTimeId', value.id);
				this.$store.commit('setSelectedTime', value.name);
			},
			selected_psychologist(value){
				this.$store.commit('setSelectedPsychologistId', value.id);
				this.$store.commit('setSelectedPsychologist', value.name);
			}
		}
	}
</script>