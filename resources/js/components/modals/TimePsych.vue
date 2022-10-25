<template id="time-psych">
	
	<div class="modal fade" id="timePsych" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="timePsychLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="timePsychLabel">Select Date, Time and Psychologist</h5>
        			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button> -->
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 border-right">

							<h5 class="card-title text-center mb-3">Review Session Details</h5>

							<ReviewBooking 
								:has-assessment="hasAssessment"
								:is-firsttimer="isFirsttimer"
								:self-harm="selfHarm"
								:harm-other-people="harmOtherPeople"
								:participants="participants"
								/>
						</div>
							
						<div class="col-md-6">

							<input type="hidden" name="selected_date" :value="getSelectedDate">

							<!-- Hidden Input for time id that will be pass in the request -->
							<input type="hidden" name="time_id" :value="getSelectedTimeId">

							<!-- Hidden input for psychologist that will be pass in the request -->
							<input type="hidden" name="psychologist" :value="getSelectedPsychologistId">

							<!-- Time Lists Component -->
							<TimeLists />

							<!-- Psychologist Component -->
							<Psychologists />

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit" :disabled="disabledSubmitBtn">
						<i class="fa fa-check"></i>
						<span>Submit Booking</span>
					</button>
					<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" @click="cancelSubmit">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	
</template>


<script>
	
	import TimeLists from '../bookings/Timelists.vue';
	import Psychologists from '../bookings/Psychologists.vue';
	import ReviewBooking from '../bookings/ReviewBooking.vue';
	import { mapGetters, mapActions } from 'vuex';

	export default {
		name: "TimePsych",
		data(){

			return {

				selected_time: null,
				selected_psychologist: null,
				show_time_lists: true,
				show_psychologists: false,
				disabledSubmitBtn: true
			}
		},
		mounted(){

			EventBus.$on('select-time', data => {

				this.disabledSubmitBtn = !_.isNil(this.getSelectedPsychologistId) ? false : true;
			})


			EventBus.$on('select-psychologist', data => {

				this.disabledSubmitBtn = !_.isNil(data) ? false : true;	
			})
		},
		props: {
			timeLists: Array,
			selectedDate: String,
			hasAssessment: Number,
			isFirsttimer: Number,
			selfHarm: Number,
			harmOtherPeople: Number,
			participants: Array
		},
		components: {
			TimeLists,
			Psychologists,
			ReviewBooking
		},
		computed: {
			...mapGetters([
				"allPsychologists",
				"getSelectedDate",
				"getSelectedTimeId",
				"getSelectedPsychologistId",
				"getSelectedPsychologist"
			]),
			selectedPsychologist(){
				return this.$store.state.selected_psychologist
			}
		},
		methods: {

			...mapActions([
				"getPsychologists"
			]),
			cancelSubmit(){

				this.show_psychologists = false;
				this.selected_time = null;
				this.selected_psychologist = null;

				this.$store.commit('setSelectedTimeId', null);
				this.$store.commit('setSelectedTime', null);

				this.$store.commit('setSelectedPsychologistId', null);
				this.$store.commit('setSelectedPsychologist', null);

				this.disabledSubmitBtn = true;

			}
		}
	}
</script>