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
						<button class="btn btn-primary" type="submit" :disabled="disabledSaveChanges">
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
				// "getSelectedDate"
			])
		},
		mounted(){
			EventBus.$on('select-a-reason', (data) => {
				console.log(data)

				if(data.reason.id !== 5 || data.reason.name !== "Others"){

					this.disabledSaveChanges = false;

				}else if(data.others_specify.length > 10){

					this.disabledSaveChanges = false;
				}else{

					this.disabledSaveChanges = true;
				}

			})
		},
		components: {
			TimeLists,
			Psychologists,
			RescheduleReview,
			ReasonComponent
		},
		methods: {
			// ...mapActions(["getPsychologists"])
		}
	}
</script>