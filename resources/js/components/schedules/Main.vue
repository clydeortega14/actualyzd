<template>
	<div>
		<FullCalendar :options="options" />

		<TimeSchedule v-if="showModal" @close="showModal = false"/>
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
					select(arg){
						console.log(arg)
						$('#create-schedule').modal('show');
					}
				},
				showModal: true
			}
		},
		components: {

			TimeSchedule
		},
		methods: {

			handleSelect(argument){
				console.log(argument)
			}

		}
	}
</script>