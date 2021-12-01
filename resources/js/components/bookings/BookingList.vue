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
						<th></th>
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
								:own-booking="booking"
							/>
						</td>
						<td>
							<a :href="jitsiUrl+booking.link_to_session" target="_blank" v-if="currentTime(booking) === 'show_link'">
								<i class="fa fa-link"></i>
							</a>
							<span v-else-if="currentTime(booking) === 'upcoming'">
								<small>Link to session will be generated 30 minutes before the designated schedule</small>
							</span>

							<span v-else>
								<small>Link not available</small>
							</span>
						</td>
						<td>
							<a :href="`${baseUrl}/bookings/session/${booking.room_id}`" target="_blank" data-toggle="tooltip" title="view session">
								<i class="fa fa-eye"></i>
							</a>
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
	import moment from 'moment';

	export default {
		name: "BookingList",
		mixins: [ DateTime ],
		props: {
			role: String,
			userAvatar: String
		},
		data(){

			return {

				show_link: false
			}
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
				return process.env.MIX_JITSI_URL;
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
			},
			currentTime(booking){

				let mins_before = moment(booking.to_schedule.start+' '+booking.time.from).subtract(30, 'minutes').format('HH:mm');

				let current_time = moment().format('HH:mm');
				let time_from = moment(booking.to_schedule.start+' '+booking.time.from).format('HH:mm')
				let time_to = moment(booking.to_schedule.start+' '+booking.time.to).format('HH:mm')


				let current_date = moment().format('YYYY-MM-DD');
				let booking_date = booking.to_schedule.start;

				if(booking.to_status.id === 1 && current_date < booking_date){

					return 'upcoming';
				}

				if(booking.to_status !== 1 && current_date > booking_date){

					return 'passed';
				}

				if(booking.to_status.id === 1 && current_date === booking_date){

					if(current_time.toString() >= mins_before.toString){

						return 'show_link';

					}else if(current_time.toString() > time_from.toString() || current_time.toString() > time_to.toString()){

						return 'passed';

					}else{

						return 'upcoming';
					}
				}
			}
		}
	}
</script>