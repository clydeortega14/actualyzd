<template>
	<div>
		<StatusNav @filter-by-status="filterStatus" />
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>DateTime</th>
						<th>Type</th>
						<th>Counselee</th>
						<th>Psychologist</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="booking in allBookings" :key="booking.id">
							<td>{{ `${booking.to_schedule.start} @ ${booking.time.from} - ${booking.time.to}` }}</td>
							<td>{{ booking.session_type.name }}</td>
							<td>
								<a href="#">
									<img :src="`/images/user.png`" :alt="booking.to_counselee.name" class="rounded-circle"
									width="50" height="50">
								</a>
							</td>
							<td>
								<a href="#">
									<img src="/images/profile.png" :alt="booking.to_schedule.psych.name"
									class="rounded-circle" width="50" height="50">
								</a>
							</td>
							<td>
								<BookingStatus :session-status="booking.to_status.name" :booking-id="booking.id"/>
							</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex'
	import BookingStatus from './BookingStatus.vue';
	import StatusNav from './StatusNav.vue';

	export default {
		name: "BookingList",
		created(){
			this.getAllBookings();
		},
		computed: {
			...mapGetters(["allBookings"])
		},
		components: {
			BookingStatus,
			StatusNav
		},
		methods: {
			...mapActions(["getAllBookings"]),
			filterStatus(id){
				this.getAllBookings({
					status: id
				})
			}
		}
	}
</script>