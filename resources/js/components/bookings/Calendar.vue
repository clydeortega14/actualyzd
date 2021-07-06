<template>
	<div id="date-time-container">

		<FullCalendar :options="calendarOptions" />

		<TimeComponent 
			v-if="show_time_component"
			:time_lists="getTimeLists"
			:selected_date="selected_date" 
			@select-time="selectTime" />

		<div class="form-group mt-4" v-if="show_actions">
			<button class="btn btn-primary btn-block">Proceed Next</button>
			<a href="#" class="btn btn-secondary btn-block">Cancel</a>
		</div>
	</div>
</template>

<script>

	import FullCalendar from '@fullcalendar/vue';
	import dayGridPlugin from '@fullcalendar/daygrid';
	import interactionPlugin from '@fullcalendar/interaction';

	import TimeComponent from '../TimeComponent';

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
				show_actions: false,
				show_time_component: false
			}
		},
		computed:{

			...mapGetters(["getTimeLists"])
		},
		components: {
			TimeComponent
		},
		methods: {

			...mapActions(["timeLists"]),

			handleDateClick(arg){

				this.show_time_component = false;
				this.selected_date = null;
				this.show_actions = false;
			},
			handleEventClick(arg){

				this.show_time_component = true;
				this.selected_date = arg.event.startStr;
				this.timeLists(arg.event.id)
				
			},
			selectTime(time){

				this.show_actions = true;
			}
		}
	}
</script>