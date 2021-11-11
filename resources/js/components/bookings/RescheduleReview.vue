<template>
	<div>
		<ul class="list-group mt-3">
			<li class="list-group-item d-flex justify-content-between align-items-center" v-if="getSelectedDate !== null">
				Rescheduled Date
				<span>{{ wholeDate(getSelectedDate) }}</span>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center" v-if="getSelectedTime !== null">
				Time
				<span>{{ getSelectedTime }}</span>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center" v-if="getSelectedPsychologist !== null">
				Psychologist
				<span>{{ getSelectedPsychologist }}</span>
			</li>

			<li class="list-group-item d-flex justify-content-between align-items-center" v-if="getSelectedReasonName !== null">
				Reason
				<span>{{ getSelectedReasonName }}</span>
			</li>
		</ul>
	</div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex';
	import DateTime from '../../mixins/datetime.js';

	export default {

		name: "RescheduleReview",
		mixins: [ DateTime ],
		computed: {

			...mapGetters([
				'getSelectedDate',
				'getSelectedTime',
				'getSelectedPsychologist',
				'getSelectedReasonName'
			])
		}
	}
</script>