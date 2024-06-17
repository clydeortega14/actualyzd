<style scoped>
	
	.highlighted {

		background-color: yellow;
	}
	.unstyled-list {
		list-style-type: none;
	}
</style>

<template>
	<div>

		<!-- Filter and Search Booking -->
		<!-- <FilSearchComponent /> -->

		<!-- Filter By Status -->
		<StatusNav @filter-by-status="filterStatus" />

		
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Description</th>
						
						<th v-if="role !== 'member'" style="text-align: right;">
							Progress Report
						</th>
						
						
						<!-- <th>Link to session</th> -->
					</tr>
				</thead>
				<tbody>
					<tr v-for="booking in allBookings" :key="booking.id">
						<!-- <td v-if="role !== 'member'" width="10px" align="center">
							<a href="#">
								<img :src="( booking.counselee == null) ? `/images/user.png` : `${baseUrl}/storage/${booking.to_counselee.avatar}`" 
								:alt="booking.to_counselee == null ? 'N/A' : booking.to_counselee.name" 
								data-toggle="tooltip" 
								:title="booking.to_counselee == null ? 'N/A' : booking.to_counselee.name" class="rounded-circle"
								width="50" 
								height="50">
								
							</a>
						</td>
						<td v-if="role === 'member'" width="10px" align="center">
							<a href="#">
								<img :src="booking.to_schedule.psych.avatar == null ? '/images/profile.png' : `${baseUrl}/storage/${booking.to_schedule.psych.avatar}`" :alt="booking.to_schedule.psych.name" data-toggle="tooltip" :title="booking.to_schedule.psych.name"
								class="rounded-circle" width="50" height="50">
							</a>
						</td> -->
						<td>
							<div>
								<a :href="`${baseUrl}/bookings/session/${booking.room_id}`">
									{{ wholeDate(booking.to_schedule.start)+' @ '+`${wholeTime(booking.time.from)} - ${wholeTime(booking.time.to) }`  }}
								</a> <br />
								<span class="badge badge-secondary">{{ booking.session_type.name }}</span>
								<span :class=booking.to_status.class>{{ booking.to_status.name }}</span>
							</div>
							
						</td>
						
						<td v-if="role !== 'member'" align="right">
							<div v-if="booking.counselee !== null && booking.to_counselee.progress_reports.length && booking.to_status.id == 1">
								<a :href="oldReportLink(booking.to_counselee.progress_reports[0].booking_id)" target="_blank">
									<i class="fa fa-book"></i>
								</a>
							</div>
							<span class="badge badge-info" v-else>N/A</span>
						</td>
						<!-- <td width="15px">
							<div class="dropdown">
								<button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
								    Action
								</button>
							  	<div class="dropdown-menu">
							    	<a class="dropdown-item" :href="`${baseUrl}/bookings/session/${booking.room_id}`">Session Profile</a>
							    	<a class="dropdown-item" href="#">Link to session</a>
							  	</div>
							</div>
						</td> -->
						
						<!-- <td>
							<span :class="booking.to_status.class">{{ booking.to_status.name }}</span>
							<BookingStatus 
								:session-status="booking.to_status.name" 
								:booking-id="booking.id" 
								:booking-status="booking.to_status.id"
								:reschedule="booking.reschedule"
								:cancelled="booking.cancelled"
								:own-booking="booking"
							/>
						</td> -->
						<!-- <td>
							<a :href="jitsiUrl+booking.link_to_session" target="_blank" v-if="currentTime(booking) === 'show_link'">
								<i class="fa fa-link"></i>
							</a>

							<a :href="jitsiUrl+booking.link_to_session" v-else-if="currentTime(booking) === 'upcoming'" target="_blank">
								<i class="fa fa-link"></i>
								<span class="ml-2">Link To Session</span>
							</a>

							<span v-else>
								<small>Link not available</small>
							</span>
						</td> -->
						<!-- <td>
							<a :href="`${baseUrl}/bookings/session/${booking.room_id}`" target="_blank" data-toggle="tooltip" title="view session">
								<i class="fa fa-eye"></i>
							</a>
						</td> -->
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex'
	import BookingStatus from './BookingStatus.vue';
	import FilSearchComponent from './FilSearchComponent.vue';
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
			StatusNav,
			FilSearchComponent
		},
		methods: {
			...mapActions(["getAllBookings"]),
			filterStatus(id){
				this.getAllBookings({ status: id })
			},
			sessionDetailsUrl(){

				return `${this.baseUrl}/bookings/session/${booking.room_id}`;
			},
			videoChatUrl(booking){

				return `${window.location.origin}/video-chat/${booking.room_id}`
			},
			oldReportLink(booking_id){

				return `${this.baseUrl}/progress-reports/create-for-booking/${booking_id}`
			},
			currentTime(booking){

				let mins_before = moment(booking.to_schedule.start+' '+booking.time.from).subtract(30, 'minutes').format('HH:mm');
				let format = 'hh:mm:ss';

				let current_time = moment();
				let time_from = moment(booking.to_schedule.start+' '+booking.time.from).format(format)
				let time_to = moment(booking.to_schedule.start+' '+booking.time.to).format(format)


				let current_date = moment().format('YYYY-MM-DD');
				let booking_date = booking.to_schedule.start;

				if(booking.to_status.id === 1 && current_date < booking_date){

					return 'upcoming';
				}

				if(booking.to_status !== 1 && current_date > booking_date){

					return 'passed';
				}

				if(booking.to_status.id === 1 && current_date === booking_date){

					if(current_time.isBetween(time_from, time_to)){

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