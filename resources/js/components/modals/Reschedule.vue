<template id="reschedule">
	
		<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rescheduleLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="rescheduleLabel">Please Select Time and Psychologist</h5>
					</div>
					<div class="modal-body">
						<!-- Select Time and Psychologists Component -->

						<TimeLists />

						<Psychologists />

					</div>
				</div>
				
			</div>
		</div>
	

</template>


<script>
	
	import TimeLists from '../bookings/Timelists.vue';
	import Psychologists from '../bookings/Psychologists.vue';

	export default {
		name: "Reschedule",
		components: {
			TimeLists,
			Psychologists
		}
	}
</script>