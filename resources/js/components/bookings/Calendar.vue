<template>
	<div id="date-time-container">

		<FullCalendar :options="calendarOptions" />

		<!-- Modal For Selecting Time and Psychologist -->
		<TimePsych ref="modal"
			:selected-date="selected_date" 
			:time-lists="getTimeByDate"
			:has-assessment="hasAssessment"
			:is-firsttimer="isFirsttimer"
			:self-harm="selfHarm"
			:harm-other-people="harmOtherPeople"
			:participants="participants"
			/>


		<div class="form-group mt-4" v-if="show_actions">
			<button class="btn btn-primary btn-block" type="submit">Proceed Next</button>
			<a href="#" class="btn btn-secondary btn-block">Cancel</a>
		</div>
	</div>
</template>

<script>

	import FullCalendar from '@fullcalendar/vue';
	import dayGridPlugin from '@fullcalendar/daygrid';
	import interactionPlugin from '@fullcalendar/interaction';

	import TimeComponent from '../TimeComponent';
	import TimePsych from '../modals/TimePsych';

	import Swal from 'sweetalert2';

	import { mapGetters, mapActions } from 'vuex';
	
	export default {

		data(){

			return {

				calendarOptions: {

					plugins:[dayGridPlugin, interactionPlugin],
					initialView: 'dayGridMonth',
					dateClick: this.handleDateClick,
					selectable: true,
					events: {
						url: '/psychologist/schedules'
					}
				},
				selected_date: null,
				schedule_id: null,
				show_actions: false,
				show_time_component: false
			}
		},
		props: {
			hasAssessment: Number,
			isFirsttimer: Number,
			selfHarm: Number,
			harmOtherPeople: Number,
			participants: Array
		},
		computed:{

			...mapGetters([
				"getTimeLists",
				"getTimeByDate",
				"getSelectedDate",
				"getSelectedTime",
				"getSelectedPsychologist"
			])
		},
		components: {
			TimeComponent,
			TimePsych
		},
		methods: {

			...mapActions([
				"timeLists",
				"timeByDate"
			]),

			handleDateClick(arg){

				this.timeByDate({
					date: arg.dateStr
				}).then(response => {
					let data = response.data

					if(data.success){

						// check length of data
						if(data.data.length > 0){

							let element = this.$refs.modal.$el;

							$(element).modal('show');

							this.selected_date = arg.dateStr;

							this.$store.commit('setTimeByDate', data.data);

							this.$store.commit('setSelectedDate', this.selected_date);
							
							this.$store.commit('setShowBookingReview', true);
						}else{

							Swal.fire('Oops!', 'Selected date has no schedule please select another date', 'error');
						}
					}

				}).catch(error => {
					console.log(error)
				})

				
			},
			selectTime(time){

				this.show_actions = true;
			}
		}
	}
</script>