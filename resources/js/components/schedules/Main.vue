<template>
	<div>
		<FullCalendar ref="fullCalendar" :options="options" />

		<TimeSchedule ref="show_time_modal" />
	</div>
</template>

<script>

	import FullCalendar from '@fullcalendar/vue';
	import dayGridPlugin from '@fullcalendar/daygrid';
	import interactionPlugin from '@fullcalendar/interaction';

	import TimeSchedule from '../modals/Booking.vue';
	
	export default {

		data(){

			return {

				options: {
					plugins: [ dayGridPlugin, interactionPlugin ],
					initialView: 'dayGridWeek',
					editable: true,
					selectable: true,
					navLinks: true,
					select: this.handleSelect,
					events: [

						{ title: 'event 1', start: '2021-11-17 14:30:00', end: '2021-11-17 15:30:00', allDay: false },
          				{ title: 'event 2', date: '2021-11-17' }
					]
				},
			}
		},
		components: {

			TimeSchedule
		},
		methods: {

			handleSelect(argument){
				let element = this.$refs.show_time_modal.$el;
				$(element).modal('show');
			}

		}
	}
</script>