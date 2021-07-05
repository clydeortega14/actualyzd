<template>
	<div id="date-time-container">

		<button type="button" @click.prevent="scrollToEnd"></button>

		<FullCalendar :options="calendarOptions" />


		<TimeComponent />
	</div>
</template>

<script>

	import FullCalendar from '@fullcalendar/vue';
	import dayGridPlugin from '@fullcalendar/daygrid';
	import interactionPlugin from '@fullcalendar/interaction';

	import TimeComponent from '../TimeComponent';
	
	export default {

		data(){

			return {

				calendarOptions: {

					plugins:[dayGridPlugin, interactionPlugin],
					initialView: 'dayGridMonth',
					selectable: true
				}
			}
		},
		mounted(){

			this.scrollToEnd();
		},
		components: {
			TimeComponent
		},
		methods: {

			scrollToEnd: function(){

				//
			}
		}
	}
</script>