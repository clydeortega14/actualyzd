<template>
	<div id="date-time-container">

		<FullCalendar :options="calendarOptions" />

		<TimeComponent 
			v-if="show_time_component"
			:time_lists="getTimeLists"
			:selected_date="selected_date" 
			@select-time="selectTime" />

		<!-- Modal For Selecting Time and Psychologist -->
		<TimePsych ref="modal"
			:selected-date="selected_date" 
			:time-lists="getTimeByDate"
			/>

		<!-- for schedule id hidden input -->
		<input type="hidden" name="schedule_id" :value="schedule_id">

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

	import { mapGetters, mapActions } from 'vuex';
	
	export default {

		data(){

			return {

				calendarOptions: {

					plugins:[dayGridPlugin, interactionPlugin],
					initialView: 'dayGridMonth',
					dateClick: this.handleDateClick,
					eventClick: this.handleEventClick,
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
		computed:{

			...mapGetters([
				"getTimeLists",
				"getTimeByDate"
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

				let element = this.$refs.modal.$el;
				$(element).modal('show');

				this.timeByDate({
					date: arg.dateStr
				})


				// this.show_time_component = false;
				this.selected_date = arg.dateStr;
				// this.show_actions = false;
			},
			handleEventClick(arg){

				this.schedule_id = arg.event.id;
				this.show_time_component = true;
				this.selected_date = arg.event.startStr;
				this.timeLists(this.schedule_id);
				
			},
			selectTime(time){

				this.show_actions = true;
			}
		}
	}
</script>