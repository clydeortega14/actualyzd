<template>
	<div>
		<StatusNav @filter-by-status="filterStatus" />
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>DateTime</th>
						<th>Type</th>
						<th v-if="role !== 'member'">
							Progress Report
						</th>
						<th v-if="role !== 'member'">Counselee</th>
						<th>Psychologist</th>
						<th>Status</th>
						<th>Link to session</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="booking in allBookings" :key="booking.id">
						<td>
							<b>Date: </b><span>{{ `${wholeDate(booking.to_schedule.start)}` }}</span> <br>
							<b>Time: </b><span>{{ `${wholeTime(booking.time.from)} - ${wholeTime(booking.time.to) }`}}</span>
						</td>
						<td>{{ booking.session_type.name }}</td>
						<td v-if="role !== 'member'">
							<div v-if="booking.counselee !== null && booking.to_counselee.progress_reports.length && booking.to_status.id == 1">
								<a :href="oldReportLink(booking.to_counselee.progress_reports[0].booking_id)" target="_blank">
									<i class="fa fa-book mr-2"></i>
									<span>report</span>
								</a>
							</div>
							<span class="badge badge-info" v-else>N/A</span>
						</td>
						<td v-if="role !== 'member'">
							<a href="#">
								<img :src="( booking.counselee == null) ? `/images/user.png` : `${baseUrl}/storage/${booking.to_counselee.avatar}`" 
								:alt="booking.to_counselee == null ? 'N/A' : booking.to_counselee.name" 
								data-toggle="tooltip" 
								:title="booking.to_counselee == null ? 'N/A' : booking.to_counselee.name" class="rounded-circle"
								width="50" 
								height="50">
							</a>
						</td>
						<td>
							<a href="#">
								<img :src="booking.to_schedule.psych.avatar == null ? '/images/profile.png' : `${baseUrl}/storage/${booking.to_schedule.psych.avatar}`" :alt="booking.to_schedule.psych.name" data-toggle="tooltip" :title="booking.to_schedule.psych.name"
								class="rounded-circle" width="50" height="50">
							</a>
						</td>
						<td>
							<BookingStatus 
								:session-status="booking.to_status.name" 
								:booking-id="booking.id" 
								:booking-status="booking.to_status.id"
								:reschedule="booking.reschedule"
								:cancelled="booking.cancelled"
							/>
						</td>
						<td>
							<a :href="jitsiUrl+booking.link_to_session" target="_blank" v-if="booking.to_status.id === 1">
								<i class="fa fa-link"></i>
							</a>
							<span v-else class="badge badge-secondary">Link not available</span>
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
	import DateTime from '../../mixins/datetime.js';
	import DEFAULT_URL from '../../constants/url.js';

	export default {
		name: "BookingList",
		mixins: [ DateTime ],
		props: {
			role: String,
			userAvatar: String
		},
		created(){
			this.getAllBookings();
		},
		computed: {
			...mapGetters(["allBookings"]),
			baseUrl(){

				return window.location.origin;
			},
			jitsiUrl(){
				return process.env.MIX_JITSI_URL + '3123sda';
			}
		},
		components: {
			BookingStatus,
			StatusNav
		},
		methods: {
			...mapActions(["getAllBookings"]),
			filterStatus(id){
				this.getAllBookings({ status: id })
			},
			videoChatUrl(booking){

				return `${window.location.origin}/video-chat/${booking.room_id}`
			},
			oldReportLink(booking_id){

				return `${this.baseUrl}/progress-reports/create-for-booking/${booking_id}`
			}
		}
	}
</script>