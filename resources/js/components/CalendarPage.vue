<template>
	<div>
		<FullCalendar :options="calendarOptions" />

		<TimeComponent />
	</div>
</template>

<script>
	
	import FullCalendar from '@fullcalendar/vue';
	import dayGridPlugin from '@fullcalendar/daygrid';
	import interactionPlugin from '@fullcalendar/interaction';

	import TimeComponent from './TimeComponent';

	export default {

		data(){

			return {

				calendarOptions: {

					plugins: [ dayGridPlugin, interactionPlugin ],
					initialView: 'dayGridMonth',
					dateClick: this.handleDateClick,
					events: {
						url: '/psychologist/schedules',
					}
				},

			}
		},
		components: {
			FullCalendar,
			TimeComponent
		},
		methods: {
			handleDateClick(argument){
				console.log(argument)
			},


		}
	}
</script>