<template id="reschedule">
	
		<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rescheduleLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="rescheduleLabel">Please Select Time and Psychologist</h5>
					</div>
					<div class="modal-body">
						<!-- Select Time and Psychologists Component -->
						<div class="row">
							<div class="col-md-6 border-right">
								<!-- Review Booking Component -->
								<RescheduleReview />

							</div>

							<div class="col-md-6">
								<!-- Time Lists Component -->
								<TimeLists />

								<!-- Psychologist Component -->
								<Psychologists />

								<!-- Reason For Rescheduling Component -->
								<ReasonComponent />
								
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button class="btn btn-primary" type="submit" :disabled="disabledSaveChanges" @click="saveRescheduleBooking">
							<i class="fa fa-check"></i>
							<span>Save Changes</span>
						</button>
						<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
					</div>
				</div>
				
			</div>
		</div>
	

</template>


<script>
	
	import TimeLists from '../bookings/Timelists.vue';
	import Psychologists from '../bookings/Psychologists.vue';
	import RescheduleReview from '../bookings/RescheduleReview.vue';
	import ReasonComponent from '../bookings/ReasonComponent.vue';

	import Swal from 'sweetalert2';

	import { mapGetters, mapActions } from 'vuex';

	export default {
		name: "Reschedule",
		data(){
			return {

				show_psychologists_component: false,
				disabledSaveChanges: true
			}
		},
		computed: {

			...mapGetters([
				"getBooking",
				"getSelectedDate",
				"getSelectedTimeId",
				"getSelectedPsychologistId",
				"getSelectedReasonID",
				"getSelectedReasonName",
				"getUserId"
			])
		},
		mounted(){
			EventBus.$on('select-a-reason', (data) => {

				this.disabledSaveChanges = data.reason.id !== 5 || data.reason.name !== "Others" ? false : true
			});

			EventBus.$on('enable-save-button', (data) => {

				this.disabledSaveChanges = data.length >= 10 ? false : true;
			});


			EventBus.$on('select-time', (data) => {
				this.disabledSaveChanges = true;
			});
		},
		components: {
			TimeLists,
			Psychologists,
			RescheduleReview,
			ReasonComponent
		},
		methods: {
			...mapActions(["rescheduleBooking"]),
			saveRescheduleBooking(e){

				e.preventDefault();

				let payload = {

					booking_id: this.getBooking.id,
					date: this.getSelectedDate,
					time_id: this.getSelectedTimeId,
					psychologist_id: this.getSelectedPsychologistId,
					reason_option_id: this.getSelectedReasonID,
					updated_by: this.getUserId,
					others_specify: this.getSelectedReasonName
				}
				
				this.rescheduleBooking(payload)
					.then(response => {

						if(response.status === 200){

							Swal.fire(
								response.data.success ? 'Success!' : 'Oops!', 
								response.data.message, 
								response.data.success ? 'success' : 'warning'
							);
						}
					})
					.catch(error => {

						if(error.response.status === 403 || error.response.status === 422){

							let data = error.response.data;

							if(!data.success) Swal.fire('Oops!', data.message, 'error');
						}
					})
			}
		}
	}
</script>