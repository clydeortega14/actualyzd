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
					initialView: 'dayGridMonth',
					editable: true,
					selectable: true,
					navLinks: true,
					select: this.handleSelect,
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