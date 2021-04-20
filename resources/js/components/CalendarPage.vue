<template>
	<div>
		<FullCalendar 
			:options="calendarOptions" />
	</div>
</template>

<script>


	import FullCalendar from '@fullcalendar/vue';
	import dayGridPlugin from '@fullcalendar/daygrid';
	import interactionPlugin from '@fullcalendar/interaction';

	export default {

		data(){

			return {

				calendarOptions: {

					plugins: [ dayGridPlugin, interactionPlugin ],
					initialView: 'dayGridMonth',
					dateClick: this.handleDateClick,
					selectable: true,
					events: {
						url: '/psychologist/schedules',
					}
				},

			}
		},
		components: {

			FullCalendar
		},
		methods: {
			handleDateClick(argument){

				console.log(argument)
			},


		}
	}
</script>